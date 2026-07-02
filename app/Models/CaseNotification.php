<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseNotification extends Model
{
    use HasFactory;

    public const PENDING = 'pending';
    public const SENT = 'sent';
    public const FAILED = 'failed';

    protected $fillable = [
        'medical_case_workflow_id', 'channel', 'recipient', 'message', 'status', 'sent_at',
    ];

    protected $casts = ['sent_at' => 'datetime'];

    public function case()
    {
        return $this->belongsTo(MedicalCaseWorkflow::class, 'medical_case_workflow_id');
    }
}
