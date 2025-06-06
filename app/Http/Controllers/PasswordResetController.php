<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventUser;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'new_password' => 'required|min:6'
        ]);

        $user = EventUser::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password has been reset successfully.']);
    }
}
