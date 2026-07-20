<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MedicalCaseWorkflow extends Model
{
    use HasFactory;

    // Workflow statuses
    public const DRAFT = 'draft';
    public const SENT_TO_CNAMGS = 'sent_to_cnamgs';
    public const RECEIVED_BY_CNAMGS = 'received_by_cnamgs';
    public const IN_REVIEW = 'in_review';
    public const MISSING_INFORMATION = 'missing_information';
    public const READY = 'ready';
    public const COMPLETED = 'completed';
    public const CANCELLED = 'cancelled';

    /** Statuses the CNAMGS is allowed to set (role gate — see TRANSITIONS for order). */
    public const CNAMGS_STATUSES = [
        self::RECEIVED_BY_CNAMGS,
        self::IN_REVIEW,
        self::MISSING_INFORMATION,
        self::READY,
        self::COMPLETED,
        self::CANCELLED,
    ];

    /** Terminal statuses: a case that reached one can no longer move. */
    public const TERMINAL_STATUSES = [self::COMPLETED, self::CANCELLED];

    /**
     * Allowed state transitions: current status => statuses reachable from it.
     *
     * Until now any status could be set from any other, so a COMPLETED or
     * CANCELLED case could be dragged back to an earlier step, and a case could
     * jump straight to COMPLETED without ever being instructed. Staying on the
     * same status is always allowed (re-saving a note is a legitimate action).
     */
    public const TRANSITIONS = [
        self::DRAFT => [self::SENT_TO_CNAMGS, self::CANCELLED],
        // A CNAMGS agent legitimately opens a freshly sent case straight into
        // review without ticking "received" first.
        self::SENT_TO_CNAMGS => [self::RECEIVED_BY_CNAMGS, self::IN_REVIEW, self::MISSING_INFORMATION, self::CANCELLED],
        self::RECEIVED_BY_CNAMGS => [self::IN_REVIEW, self::MISSING_INFORMATION, self::READY, self::CANCELLED],
        self::IN_REVIEW => [self::MISSING_INFORMATION, self::READY, self::CANCELLED],
        self::MISSING_INFORMATION => [self::IN_REVIEW, self::READY, self::CANCELLED],
        self::READY => [self::COMPLETED, self::CANCELLED],
        self::COMPLETED => [],
        self::CANCELLED => [],
    ];

    protected $fillable = [
        'tracking_number', 'folder_id', 'patient_name', 'patient_phone',
        'doctor_id', 'cnamgs_id', 'status', 'doctor_note', 'cnamgs_note',
        'patient_note', 'sent_to_cnamgs_at', 'received_by_cnamgs_at',
        'processed_at', 'completed_at',
    ];

    protected $casts = [
        'sent_to_cnamgs_at' => 'datetime',
        'received_by_cnamgs_at' => 'datetime',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $case) {
            if (empty($case->tracking_number)) {
                $case->tracking_number = self::generateTrackingNumber();
            }
        });
    }

    public static function generateTrackingNumber(): string
    {
        $prefix = config('relief.tracking_prefix', 'RS');
        do {
            $number = $prefix . '-' . strtoupper(Str::random(6));
        } while (self::where('tracking_number', $number)->exists());

        return $number;
    }

    /** Statuses reachable from the case's current status. */
    public function allowedTransitions(): array
    {
        return self::TRANSITIONS[$this->status] ?? [];
    }

    /** True when the case may move to $newStatus (same status is a no-op). */
    public function canTransitionTo(string $newStatus): bool
    {
        return $newStatus === $this->status
            || in_array($newStatus, $this->allowedTransitions(), true);
    }

    /** True when the case reached a terminal status and can no longer move. */
    public function isTerminal(): bool
    {
        return in_array($this->status, self::TERMINAL_STATUSES, true);
    }

    /**
     * Change status, stamp the relevant timestamp, and record history.
     *
     * Invariant guard: callers should offer only allowedTransitions() so the
     * user gets a validation error; reaching this exception means a forbidden
     * transition slipped through.
     *
     * @throws \DomainException on a forbidden transition
     */
    public function changeStatus(string $newStatus, ?int $changedBy = null, ?string $note = null): void
    {
        if (! $this->canTransitionTo($newStatus)) {
            throw new \DomainException(
                "Transition interdite : {$this->status} → {$newStatus} (dossier {$this->tracking_number})."
            );
        }

        $old = $this->status;

        $this->status = $newStatus;
        match ($newStatus) {
            self::SENT_TO_CNAMGS => $this->sent_to_cnamgs_at ??= now(),
            self::RECEIVED_BY_CNAMGS => $this->received_by_cnamgs_at ??= now(),
            self::COMPLETED => $this->completed_at ??= now(),
            default => null,
        };
        if (in_array($newStatus, [self::IN_REVIEW, self::READY, self::COMPLETED], true)) {
            $this->processed_at ??= now();
        }
        $this->save();

        $this->statusHistories()->create([
            'old_status' => $old,
            'new_status' => $newStatus,
            'changed_by' => $changedBy,
            'note' => $note,
        ]);
    }

    /** Human-readable, patient-safe label for a status. */
    public static function patientLabel(string $status): string
    {
        return [
            self::DRAFT => 'Dossier en préparation.',
            self::SENT_TO_CNAMGS => 'Votre dossier a été envoyé à la CNAMGS.',
            self::RECEIVED_BY_CNAMGS => 'Votre dossier a été reçu par la CNAMGS.',
            self::IN_REVIEW => 'Votre dossier est en cours de traitement par la CNAMGS.',
            self::MISSING_INFORMATION => 'Votre dossier nécessite des informations complémentaires. Relief Services vous contactera.',
            self::READY => 'Votre dossier est prêt.',
            self::COMPLETED => 'Votre dossier est terminé.',
            self::CANCELLED => 'Votre dossier a été annulé. Contactez Relief Services.',
        ][$status] ?? 'Statut inconnu.';
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function cnamgs()
    {
        return $this->belongsTo(User::class, 'cnamgs_id');
    }

    public function statusHistories()
    {
        return $this->hasMany(MedicalCaseStatusHistory::class)->latest();
    }

    public function notifications()
    {
        return $this->hasMany(CaseNotification::class);
    }
}
