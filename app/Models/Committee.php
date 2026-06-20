<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\UserCommittee;

class Committee extends Model
{
    use HasFactory;

    protected $table = 'committee';

    protected $fillable = [
        'name',
        'updated_by',
        'user_id',
        'parent_id',
    ];


    protected function casts(): array
    {
        return [
            'updated_by' => 'integer',
            'user_id' => 'integer',
            'parent_id' => 'integer',
        ];
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userCommittees(): HasMany
    {
        return $this->hasMany(UserCommittee::class, 'committee_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_committees', 'committee_id', 'user_id')
            ->withTimestamps();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Committee::class, 'parent_id');
    }
    public function children(): HasMany
    {
        return $this->hasMany(Committee::class, 'parent_id');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }
}
