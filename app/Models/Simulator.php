<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulator extends Model
{
    use HasFactory;

    protected $table = 'simulators';

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
