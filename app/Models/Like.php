<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'art_id',
        'user_id'
    ];


    public function art() : BelongsTo
    {
        return $this->belongsTo(Art::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
