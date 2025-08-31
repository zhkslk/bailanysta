<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $guarded = [];

    protected $appends = ['is_liked'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function getIsLikedAttribute(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
