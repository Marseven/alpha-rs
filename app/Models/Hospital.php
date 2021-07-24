<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitals';

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function sicks()
    {
    	return $this->belongsToMany(Sick::class, 'hospital_sick');
    }

    public function town()
    {
    	return $this->belongsTo(Town::class, 'town_id');
    }

    public function country()
    {
    	return $this->belongsTo(Country::class, 'country_id');
    }
}
