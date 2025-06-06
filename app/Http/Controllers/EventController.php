<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        return Auth::user()->events;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'occurs_at' => 'required|date',
        ]);

        return Auth::user()->events()->create($request->only('title', 'occurs_at', 'description'));
    }

    public function show($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$event) {
            return response()->json([
                'message' => 'The requested event was not found.'
            ], 404);
        }

        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'occurs_at' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event = Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$event) {
            return response()->json([
                'message' => 'The requested event was not found.'
            ], 404);
        }

        $event->update([
            'title' => $request->title,
            'occurs_at' => $request->occurs_at,
            'description' => $request->description,
        ]);

        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$event) {
            return response()->json([
                'message' => 'The requested event was not found.'
            ], 404);
        }

        $event->delete();

        return response()->noContent();
    }
}
