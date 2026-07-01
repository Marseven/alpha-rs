<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'label', 'description', 'price', 'price_promo', 'begin_promo',
        'end_promo', 'picture', 'user_id', 'status',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

}
