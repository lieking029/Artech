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

    protected $fillable = ['title', 'user_id', 'category_id', 'status', 'sale', 'price', 'description', 'indicator'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function artImages(): HasMany
    {
        return $this->hasMany(ArtImage::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'art_id');
    }

    public function ownedArt()
    {
        return $this->belongsTo(OwnedArt::class);
    }

    public function scopeFilter($query, array $searchTerm)
    {
        if (isset($searchTerm['art']) && $searchTerm['art'] !== null) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm['art'] . '%')->orWhere('description', 'like', '%' . $searchTerm['art'] . '%');
            });
        }

        if (isset($searchTerm['selectRange']) && $searchTerm['selectRange'] !== 'all') {
            $query->where(function ($query) use ($searchTerm) {
                if ($searchTerm['selectRange'] === '0-3000') {
                    // Filter for range 0 - 3000
                    $query->whereBetween('price', [0, 3000]);
                } elseif ($searchTerm['selectRange'] === '3000-above') {
                    // Filter for range 3000 and above
                    $query->where('price', '>=', 3000);
                }
            });
        }

        if (isset($searchTerm['saleSelect']) && $searchTerm['saleSelect'] !== 'all') {
            if ($searchTerm['saleSelect'] === '0') {
                // Filter for 'Not for Sale'
                $query->where('sale', 0); // Assuming 'for_sale' is the column name
            } elseif ($searchTerm['saleSelect'] === '1') {
                // Filter for 'For Sale'
                $query->where('sale', 1); // Assuming 'for_sale' is the column name
            }
        }

        if (isset($searchTerm['category']) && $searchTerm['category'] !== 'All') {
            $query->whereHas('category', function ($q) use ($searchTerm) {
                // Assuming 'category_name' is the field in the Category model used for category names
                $q->where('name', $searchTerm['category']);
            });
        }
    }
}
