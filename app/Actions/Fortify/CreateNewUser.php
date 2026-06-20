<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ])->validate();


        return User::create([
            'full_name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'slug' => Str::slug($input['name']) . '-' . Str::random(5),

            'address' => '',
            'fb_link' => '',
            'youtube_link' => '',
            'tiktok_link' => '',
            'photo_path' => '',

            'start_date' => now()->toDateString(),
            'end_date' => now()->addYear()->toDateString(),
        ]);
    }
}
