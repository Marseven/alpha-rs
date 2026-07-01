<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'folders';

    protected $fillable = [
        'reference', 'category', 'firstname', 'lastname', 'birthday', 'gender',
        'email', 'phone', 'price', 'join_piece', 'country_id', 'town_id',
        'service_id', 'user_id', 'status',
    ];

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
