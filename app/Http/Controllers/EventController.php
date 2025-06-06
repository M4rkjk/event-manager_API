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

    public function update(Request $request, $id)
    {
        $event = Event::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        $event->update($request->only('description'));

        return $event;
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        $event->delete();

        return response()->noContent();
    }
}
