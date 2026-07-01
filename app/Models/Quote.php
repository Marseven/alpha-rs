<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    // SoftDeletes intentionally disabled: production deploys via git-pull only
    // and cannot run migrations, so the deleted_at column is not present.
    // Re-add `use SoftDeletes` once the add_soft_deletes migration can be run.
    use HasFactory;

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
