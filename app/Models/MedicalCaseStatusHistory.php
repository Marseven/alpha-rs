<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCaseStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_case_workflow_id', 'old_status', 'new_status', 'changed_by', 'note',
    ];

    public function case()
    {
        return $this->belongsTo(MedicalCaseWorkflow::class, 'medical_case_workflow_id');
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
