<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'image_path',
    ];

    /**
     * Get the answers for the question.
     */
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class, 'question_id');
    }
} 