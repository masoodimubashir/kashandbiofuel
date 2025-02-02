<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
        ]);

    }

    public function updatePassword(Request $request)
    {


        $valdidate = Validator::make($request->all(), [
            'password' => ['required', Password::defaults()],
        ]);

        if ($valdidate->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'Form Fields are not valid',
                'errors' => $valdidate->errors(),
            ], 422);

        }

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully',
        ]);

    }


}
