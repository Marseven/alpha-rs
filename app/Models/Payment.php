<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    public function user()
    {
    	return $this->belongsTo(User::class, 'customer_id');
    }

    public function folder()
    {
    	return $this->belongsTo(Folder::class, 'folder_id');
    }

}
