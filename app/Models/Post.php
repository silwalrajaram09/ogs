<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'default_photo',
        'author_id',
        'published_at',
        'type',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // 👈 ADD THIS: Accessor for photo URL
    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (empty($this->default_photo)) {
                    return null;
                }
                
                // Check if it's already a full URL
                if (filter_var($this->default_photo, FILTER_VALIDATE_URL)) {
                    return $this->default_photo;
                }
                
                // Return storage URL
                return asset('storage/' . $this->default_photo);
            }
        );
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->name);
            }
        });
    }
}