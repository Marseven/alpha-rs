<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiQuestion extends Model
{
    use HasFactory;

    public const ANSWERED = 'answered';
    public const FAILED = 'failed';
    public const NEEDS_HUMAN_REVIEW = 'needs_human_review';

    protected $fillable = [
        'name', 'phone', 'email', 'question', 'answer', 'source_context', 'status',
    ];
}
