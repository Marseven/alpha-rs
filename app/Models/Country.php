<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = ['label', 'code', 'flag', 'status', 'user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function towns()
    {
    	return $this->hasMany(Town::class, 'country_id');
    }
}
