<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    protected $table = 'towns';

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
    	return $this->belongsTo(Country::class, 'country_id');
    }
}
