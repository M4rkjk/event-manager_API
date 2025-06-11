<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class PasswordResetController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $status = Password::reset(
            [
                'email' => $request->email,
                'password' => $request->new_password,
                'password_confirmation' => $request->new_password_confirmation,
                'token' => $request->token,
            ],
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->new_password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successful.'])
            : response()->json(['message' => __($status)], 400);
    }

    public function sendResetLinkEmail(Request $request)
    {
            $request->validate([
                'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Reset link sent to your email.'])
            : response()->json(['message' => __($status)], 400);
    }
}
