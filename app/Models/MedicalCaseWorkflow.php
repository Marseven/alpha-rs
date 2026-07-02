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
    public const SENT_TO_PHARMACY = 'sent_to_pharmacy';
    public const RECEIVED_BY_PHARMACY = 'received_by_pharmacy';
    public const IN_REVIEW = 'in_review';
    public const MISSING_INFORMATION = 'missing_information';
    public const READY = 'ready';
    public const COMPLETED = 'completed';
    public const CANCELLED = 'cancelled';

    /** Statuses a pharmacy (CNAMGS) is allowed to set. */
    public const PHARMACY_STATUSES = [
        self::RECEIVED_BY_PHARMACY,
        self::IN_REVIEW,
        self::MISSING_INFORMATION,
        self::READY,
        self::COMPLETED,
        self::CANCELLED,
    ];

    protected $fillable = [
        'tracking_number', 'folder_id', 'patient_name', 'patient_phone',
        'doctor_id', 'pharmacy_id', 'status', 'doctor_note', 'pharmacy_note',
        'patient_note', 'sent_to_pharmacy_at', 'received_by_pharmacy_at',
        'processed_at', 'completed_at',
    ];

    protected $casts = [
        'sent_to_pharmacy_at' => 'datetime',
        'received_by_pharmacy_at' => 'datetime',
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

    /**
     * Change status, stamp the relevant timestamp, and record history.
     */
    public function changeStatus(string $newStatus, ?int $changedBy = null, ?string $note = null): void
    {
        $old = $this->status;

        $this->status = $newStatus;
        match ($newStatus) {
            self::SENT_TO_PHARMACY => $this->sent_to_pharmacy_at ??= now(),
            self::RECEIVED_BY_PHARMACY => $this->received_by_pharmacy_at ??= now(),
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
            self::SENT_TO_PHARMACY => 'Votre dossier a été envoyé à la CNAMGS.',
            self::RECEIVED_BY_PHARMACY => 'Votre dossier a été reçu par la CNAMGS.',
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

    public function pharmacy()
    {
        return $this->belongsTo(User::class, 'pharmacy_id');
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
