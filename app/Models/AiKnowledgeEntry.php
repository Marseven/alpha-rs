<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Curated FAQ entry used by the AI assistant: a direct answer when a question
 * matches its keywords, and context injected into the AI prompt otherwise.
 */
class AiKnowledgeEntry extends Model
{
    protected $fillable = ['question', 'answer', 'keywords', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
