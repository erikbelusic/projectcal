<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Http\Controllers\Controller;

class GoogleLoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar'])
            ->with(['access_type' => 'offline', 'prompt' => 'consent select_account'])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $socialiteUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            [
                'email' => $socialiteUser->email,
                'google_id' => $socialiteUser->id
            ],
            [
                'name' => $socialiteUser->name,
                'refresh_token' => $socialiteUser->refreshToken,
            ]
        );

        Auth::login($user, true);

        return redirect('/');
    }
}
