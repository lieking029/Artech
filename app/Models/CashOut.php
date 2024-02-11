<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashOut extends Model
{
    use HasFactory;

    protected $fillable = ['cashout', 'status', 'user_id', 'number'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
