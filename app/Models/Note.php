<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chapter_id',
        'title_id',
        'link',
        'doc_path',
    ];

    /**
     * Scope a query to only include theory notes (with doc_path).
     */
    public function scopeTheory($query)
    {
        return $query->whereNotNull('doc_path');
    }

    /**
     * Scope a query to only include amali notes (with link).
     */
    public function scopeAmali($query)
    {
        return $query->whereNotNull('link');
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function title(): BelongsTo
    {
        return $this->belongsTo(Title::class);
    }
} 