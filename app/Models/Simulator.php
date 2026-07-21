<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulator extends Model
{
    use HasFactory;

    protected $table = 'simulators';

    protected $fillable = [
        'value', 'note', 'simulator_item_id', 'country_id', 'sick_id',
        'service_id', 'user_id', 'status',
        // Structured pricing (see 2026_07_09_000500 migration).
        'unit_price', 'quantity', 'category', 'is_optional', 'is_estimate',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity' => 'decimal:2',
        'is_optional' => 'boolean',
        'is_estimate' => 'boolean',
    ];

    /**
     * Numeric unit price for this catalog row. Uses the structured column when
     * present, otherwise best-effort parses the legacy free-text `value`
     * (e.g. "60 000 FCFA" -> 60000) so pre-existing rows still contribute a
     * number. Returns 0.0 when nothing usable is found.
     */
    public function resolvedUnitPrice(): float
    {
        if ($this->unit_price !== null) {
            return (float) $this->unit_price;
        }

        $digits = preg_replace('/[^0-9]/', '', (string) $this->value);

        return $digits === '' ? 0.0 : (float) $digits;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function sick()
    {
        return $this->belongsTo(Sick::class, 'sick_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function item()
    {
        return $this->belongsTo(SimulatorItem::class, 'simulator_item_id');
    }
}
