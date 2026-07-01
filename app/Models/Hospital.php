<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitals';

    protected $fillable = [
        'label', 'description', 'country_id', 'town_id', 'picture_1',
        'picture_2', 'status', 'user_id',
    ];

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
