<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table = 'quotes';

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
    	return $this->belongsTo(Service::class, 'service_id');
    }

    public function country()
    {
    	return $this->belongsTo(Country::class, 'country_id');
    }

    public function town()
    {
    	return $this->belongsTo(Town::class, 'town_id');
    }

}
