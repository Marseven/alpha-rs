<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // SoftDeletes intentionally disabled (git-pull-only prod cannot migrate;
    // deleted_at column absent). Re-add once the migration can run.
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'customer_id', 'folder_id', 'quote_id', 'description', 'reference',
        'amount', 'status', 'time_out', 'operator', 'transaction_id',
        'paid_at', 'expired_at',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'customer_id');
    }

    public function folder()
    {
    	return $this->belongsTo(Folder::class, 'folder_id');
    }

}
