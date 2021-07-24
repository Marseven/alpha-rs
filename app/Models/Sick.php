<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sick extends Model
{
    use HasFactory;

    protected $table = 'sicks';

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function hospitals()
    {
    	return $this->belongsToMany(Sick::class, 'hospital_sick');
    }
}
