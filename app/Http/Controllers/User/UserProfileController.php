<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = uniqid('user_') . '.' . $extension;

            $imagePath = $request->file('image')->storeAs('user_images', $filename, 'public');

            if ($user->image_path) {
                Storage::disk('public')->delete($user->image_path);
            }

            User::updateOrCreate(
                ['id' => $user->id],
                ['image_path' => $imagePath]
            );
        }

        return redirect()->back();


    }
}
