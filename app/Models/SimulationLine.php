<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * One breakdown line of a {@see Simulation}: amount = quantity x unit_price.
 */
class SimulationLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'simulation_id', 'category', 'label', 'quantity', 'unit_price',
        'amount', 'is_optional', 'is_estimate', 'source_simulator_id',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'amount' => 'decimal:2',
        'is_optional' => 'boolean',
        'is_estimate' => 'boolean',
    ];

    public function simulation()
    {
        return $this->belongsTo(Simulation::class);
    }
}
