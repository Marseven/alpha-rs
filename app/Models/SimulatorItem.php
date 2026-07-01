<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulatorItem extends Model
{
    use HasFactory;

    protected $table = 'simulator_items';

    protected $fillable = ['label', 'status'];
}
