<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';

    protected $fillable = [
        'name',
        'type',
        'description',
        'start_date',
        'end_date',
        'no_of_days',
        'location',
        'country_id',
        'parent_id',
    ];


    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'no_of_days' => 'integer',
            'country_id' => 'integer',
            'parent_id' => 'integer',
        ];
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function userProgramms(): HasMany
    {
        return $this->hasMany(UserProgramm::class, 'program_id');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_programms', 'program_id', 'user_id')
            ->withTimestamps();
    }

    public function children(): HasMany
    {
        return $this->hasMany(Program::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'parent_id');
    }}
