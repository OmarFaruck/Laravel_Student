<?php

namespace App\Http\Controllers\Admin;

use App\Models\User; 
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        // Redirect the user to the OAuth provider's authentication page
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
          $githubUser = Socialite::driver($provider)->user();
 
            $user = User::updateOrCreate([
                // 'github_id' => $githubUser->id,
                'email' => $githubUser->email,
                ], [
                // 'name' => $githubUser->name,
                'password' => bcrypt(Str::random(24)), // You might want to set a random password
                // 'github_token' => $githubUser->token,
                // 'github_refresh_token' => $githubUser->refreshToken,
            ]);
        
            Auth::login($user);
        
            return redirect()->route('dashboard.index');
    }
    
}