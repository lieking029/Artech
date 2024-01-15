<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable =
    [
        'art_id',
        'user_id'
    ];

    use HasFactory;

    public function art()
    {
        return $this->belongsTo(Art::class, 'art_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
