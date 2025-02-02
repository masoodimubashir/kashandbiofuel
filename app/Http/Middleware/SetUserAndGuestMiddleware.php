<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class SetUserAndGuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $userId = auth()->check() ? auth()->id() : null;

        $guestId = $request->cookie('guest_id');

        if (!$guestId) {

            $guestId = Str::uuid()->toString();
            Cookie::queue('guest_id', $guestId, 60 * 24 * 30);
        }

        $request->merge([
            'user_id' => $userId,
            'guest_id' => $guestId,
        ]);

        return $next($request);
    }
}
