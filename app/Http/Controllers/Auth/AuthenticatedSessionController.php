<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Service\ItemService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    public function __construct(private ItemService $itemService)
    {
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {

        return view('auth.login');

    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {


        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->hasRole('user')) {

            $user_id = auth()->id();
            $guest_id = request()->cookie('guest_id');

            $this->itemService->mergeItems($guest_id, $user_id);

            return redirect()->to('/');

        }


        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
