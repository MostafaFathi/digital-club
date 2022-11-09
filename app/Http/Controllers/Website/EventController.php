<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index($type)
    {
        $events = Event::where('type', $type)->get();
        return response()->json(['data' => $events]);
    }
    public function search()
    {
        $events = Event::where('name','like', '%'.(request()->q).'%')->get();
        return response()->json(['data' => $events]);
    }

    public function show($id)
    {
        $event = Event::where('id', $id)->with('speakers')->first();
        if (!$event) response()->json(['errors' => ['Event not found']], 422);
        $isLoggedIn = false;
        $isRegisteredBefore = false;
        $isRegisteredBeforeMessage = null;

        if (auth('member')->check()) {
            $isRegisteredBefore = EventMember::where('event_id', $event->id)->where('member_id', auth('member')->user()->id)->first();
            $isRegisteredBefore = (bool)$isRegisteredBefore;
            $isLoggedIn = true;
            $isRegisteredBeforeMessage = "You already registered";
        }
        return response()->json(['data' => $event, 'is_logged_in' => $isLoggedIn, 'is_registered_before' => $isRegisteredBefore, 'is_registered_before_message' => $isRegisteredBeforeMessage]);
    }

    public function register($id)
    {
        $event = Event::where('id', $id)->first();
        if (!$event) response()->json(['errors' => ['Event not found']], 422);
        $isLoggedIn = false;
        $isRegisteredBefore = false;
        $isRegisteredBeforeMessage = null;
        if (auth('member')->check()) {
            $isRegisteredBefore = EventMember::where('event_id', $event->id)->where('member_id', auth('member')->user()->id)->first();

            if ($isRegisteredBefore) response()->json(['errors' => ['you already registered']], 422);

            $eventMember = new EventMember();
            $eventMember->event_id = $id;
            $eventMember->member_id = auth('member')->user()->id;
            $eventMember->save();

            $isRegisteredBefore = true;
            $isRegisteredBeforeMessage = 'Congrats! You registered now';
            $isLoggedIn = true;

        }
        return response()->json(['data' => $event, 'is_logged_in' => $isLoggedIn, 'is_registered_before' => $isRegisteredBefore, 'is_registered_before_message' => $isRegisteredBeforeMessage]);
    }
}
