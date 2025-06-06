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
                'answer' => 'Could you please rephrase your question?'
            ]);
        }

        if (preg_match('/(human|talk|agent|real person)/', $message)) {
            return response()->json([
                'answer' => 'Sure, transferring you to a human operator...'
            ]);
        }

        if (preg_match('/(create|add).*event/', $message)) {
            return response()->json([
                'answer' => 'You can create an event by clicking the "Add Event" button and filling out the form.'
            ]);
        }

        if (preg_match('/(delete|remove).*event/', $message)) {
            return response()->json([
                'answer' => 'To delete an event, go to the event details and press the delete button.'
            ]);
        }

        if (preg_match('/(my events|where.*events|see.*events)/', $message)) {
            return response()->json([
                'answer' => 'You can see all your events on your dashboard after logging in.'
            ]);
        }

        if (preg_match('/(occurs|date|time field)/', $message)) {
            return response()->json([
                'answer' => 'The "occurs at" field indicates when the event is scheduled to take place.'
            ]);
        }

        return response()->json([
            'answer' => 'Sorry, I didn\'t understand. Could you please rephrase your question?'
        ]);
    }
}
