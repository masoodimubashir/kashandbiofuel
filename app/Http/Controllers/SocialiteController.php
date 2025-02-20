<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

    public function __construct(private ItemService $itemService)
    {

    }

    public function redirect()
    {

        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {

        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'email' => $googleUser->email,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'image_path' => $googleUser->avatar,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);

        Auth::login($user);


        if ($user->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        if (!$user->hasRole('user')) {
            $user->addRole('user');
        }

        $user_id = \auth()->user()->id;
        $guest_id = Cookie::get('guest_id');


        $this->itemService->mergeItems($guest_id, $user_id);


        return redirect()->to('/');
    }
}
