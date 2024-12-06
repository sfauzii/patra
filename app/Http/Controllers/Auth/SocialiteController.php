<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Socialite as ModelsSocialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $socialUser = Socialite::driver($provider)->user();

        $authuser = $this->store($socialUser, $provider);

        Auth::login($authuser);

        return redirect('/');
    }

    public function store($socialUser, $provider)
    {
        // Check if the social account already exists
        $socialAccount = ModelsSocialite::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        // If the social account doesn't exist, create a new user and social account
        if (!$socialAccount) {
            // Check if a user with the same email exists
            $user = User::where('email', $socialUser->getEmail())->first();

            // If the user doesn't exist, create a new one
            if (!$user) {
                $user = User::create([
                    'id' => (string) Str::uuid(), // generate a UUID for the user
                    'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(Str::random(24)), // Use a random password since we are using social login
                ]);
            }

            // Create the social account
            $socialAccount = $user->socialite()->create([
                'id' => (string) Str::uuid(), // generate a UUID for the social account
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
            ]);

            return $user;
        }

        // If the social account exists, return the associated user
        return $socialAccount->user;
    }
}
