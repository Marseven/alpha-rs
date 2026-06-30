<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'quotes';

    protected $fillable = [
        'reference', 'category', 'firstname', 'lastname', 'birthday', 'gender',
        'email', 'phone', 'join_piece_passport', 'join_piece_rapport',
        'join_piece_exam', 'join_piece', 'country_id', 'town_id', 'service_id',
        'user_id', 'devis', 'response', 'status', 'folder',
    ];

    protected $casts = [
        'folder' => 'boolean',
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
