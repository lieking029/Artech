<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OwnedArt extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'art_id',
    ];

    public function art()
    {
        return $this->belongsTo(Art::class, 'art_id');
    }
}
