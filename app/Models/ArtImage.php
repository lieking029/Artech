<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'art_id',
        'image'
    ];

    public function art() : BelongsTo
    {
        return $this->belongsTo(Art::class);
    }

}
