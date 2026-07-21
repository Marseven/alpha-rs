<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * A persisted, computed cost estimate: a header (inputs, total, tariff snapshot)
 * with a breakdown of {@see SimulationLine} rows. Distinct from the Simulator
 * catalog, which only holds unit tariffs.
 */
class Simulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'service_id', 'country_id', 'sick_id', 'user_id', 'folder_id',
        'contact_name', 'contact_email', 'contact_phone',
        'total', 'currency', 'tariff_version', 'valid_until', 'status',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'valid_until' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $simulation) {
            if (empty($simulation->reference)) {
                $simulation->reference = self::generateReference();
            }
        });
    }

    /** Public, non-sequential reference (e.g. SIM-3F4K92AB). */
    public static function generateReference(): string
    {
        do {
            $reference = 'SIM-' . strtoupper(Str::random(8));
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }

    public function lines()
    {
        return $this->hasMany(SimulationLine::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function sick()
    {
        return $this->belongsTo(Sick::class, 'sick_id');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
