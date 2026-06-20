<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCommittee extends Model
{
    use HasFactory;

    protected $table = 'user_committees';

    protected $fillable = [
        'user_id',
        'order_no',
        'updated_by',
        'committee_id',
    ];


    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'order_no' => 'float',
            'updated_by' => 'integer',
            'committee_id' => 'integer',
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

    public function committee(): BelongsTo
    {
        return $this->belongsTo(Committee::class, 'committee_id');
    }}
