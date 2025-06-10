<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpdeskController extends Controller
{
    public function handle(Request $request)
    {
        $message = strtolower($request->input('message'));

        if (!$message || strlen($message) < 3) {
            return response()->json([
                'answer' => 'Could you please provide more details about your question?'
            ]);
        }

        // Emberi operátor kérése
        if (preg_match('/\b(human|talk|agent|real person|operator|support)\b/', $message)) {
            return response()->json([
                'answer' => 'Certainly. I will connect you with a support agent shortly.'
            ]);
        }

        // Esemény létrehozása
        if (preg_match('/\b(create|add).*(event)\b/', $message)) {
            return response()->json([
                'answer' => 'To create a new event, click the green "+ Create new event" button located in the top-right corner. This will open a form where you can easily add the event details.'
            ]);
        }

        // Esemény törlése
        if (preg_match('/\b(delete|remove).*(event)\b/', $message)) {
            return response()->json([
                'answer' => 'To delete an event, click the red "X" button located at the end of the event row. This will remove the event easily.'
            ]);
        }

        // Saját események lekérdezése
        if (preg_match('/\b(my events|see events|where.*events)\b/', $message)) {
            return response()->json([
                'answer' => 'You can view your upcoming events in your personal dashboard after logging in.'
            ]);
        }

        // Dátum/idő mező magyarázat
        if (preg_match('/\b(occurs at|date|time|scheduled)\b/', $message)) {
            return response()->json([
                'answer' => 'The "Occurs at" field specifies when your event is planned to take place.'
            ]);
        }

        // Bejelentkezésre vonatkozó kérdések
        if (preg_match('/(how (do|can) I log in|how to log in|login help|sign in)/i', $message)) {
            return response()->json([
                'answer' => 'To log in, click the "Login" button at the top right of the page and enter your credentials.'
            ]);
        }

        //Kijelentkezésre vonatkozó kérdések
        if (preg_match('/(how (do|can) I log out|how to log out|logout|sign out)/i', $message)) {
            return response()->json([
                'answer' => 'To log out, click the logout button at the top right corner!'
            ]);
        }

        // Általános válasz
        return response()->json([
            'answer' => 'I\'m sorry, I wasn’t able to understand your request. Could you please rephrase or clarify your question?'
        ]);
    }
}
