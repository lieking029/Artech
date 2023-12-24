<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Art extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'status',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes() : HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function artImages() : HasMany
    {
        return $this->hasMany(ArtImage::class);
    }

}
