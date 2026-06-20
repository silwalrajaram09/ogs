<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[Fillable(['full_name', 'name', 'email', 'password', 'slug', 'designation', 'address', 'profile_description', 'fb_link', 'youtube_link', 'tiktok_link', 'photo_path', 'type', 'start_date', 'end_date', 'member_type', 'is_active'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser
{
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (User $user): void {
            if (empty($user->user_id)) {
                $user->user_id = (string) Str::uuid();
            }
        });
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->full_name ?? '',
            set: fn (string $value): array => ['full_name' => $value],
        );
    }

    public function userCommittees(): HasMany
    {
        return $this->hasMany(UserCommittee::class, 'user_id');
    }

    public function committees(): BelongsToMany
    {
        return $this->belongsToMany(Committee::class, 'user_committees', 'user_id', 'committee_id')
            ->withTimestamps();
    }

    public function ownedCommittees(): HasMany
    {
        return $this->hasMany(Committee::class, 'user_id');
    }

    public function userProgramms(): HasMany
    {
        return $this->hasMany(UserProgramm::class, 'user_id');
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'user_programms', 'user_id', 'program_id')
            ->withTimestamps();
    }
}
