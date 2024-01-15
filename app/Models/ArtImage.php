<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtImage extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'art_id',
        'image'
    ];

    public function art()
    {
        return $this->hasMany(Art::class);
    }
}
