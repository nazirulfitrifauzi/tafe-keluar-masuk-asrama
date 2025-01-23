<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovementHistory extends Model
{
    protected $table = 'movement_history';

    protected $guarded = [];

    protected $casts = [
        'out' => 'datetime',
        'in' => 'datetime',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
