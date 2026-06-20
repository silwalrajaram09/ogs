<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProgramm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_programms';

    protected $fillable = [
        'program_id',
        'user_id',
    ];


    protected function casts(): array
    {
        return [
            'program_id' => 'integer',
            'user_id' => 'integer',
        ];
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }}
