<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function towns()
    {
    	return $this->hasMany(Town::class, 'town_id');
    }
}
