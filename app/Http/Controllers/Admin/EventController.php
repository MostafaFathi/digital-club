<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSpeaker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $events = Event::query()->with('speakers');
        if (request()->has('q') and request()->get('q') != '') {
            $events = $events->where(function ($q) {
                $q->where('name', 'like', '%' . request()->get('q') . '%')
                    ->orwhere('description', 'like', '%' . request()->get('q') . '%')
                    ->orwhere('link', 'like', '%' . request()->get('q') . '%')
                ;
            });
        }
        if (request()->has('event_type_id') and request()->get('event_type_id') != '') {
            $events = $events->where('type', request()->get('event_type_id'));
        }
        $events = $events->get();
        return response()->json(['data' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'event_date' => 'required',
            'type' => 'required',
        ]);
        $event = new Event();
        $event->name = $request->name;
        $event->link = $request->link;
        $event->description = $request->description;
        $event->event_date = $request->event_date;
        $event->type = $request->type;
        $event->difficulty = $request->difficulty;
        $event->language = $request->language;
        $event->venue = $request->venue;
        $event->location = $request->location;
        $event->objectives = $request->objectives;
        $event->details = $request->details;
        $event->fees = $request->fees;

        $event->save();

        foreach (json_decode($request->speakers, true) ?? [] as $speaker) {
            $item = new EventSpeaker();
            $item->event_id = $event->id;
            $item->name = $speaker['name'];
            $item->save();
        }
        return response()->json(['data' => $event]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $event = Event::with('department')->find($id);
        return response()->json(['data' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $event = Event::with('speakers')->find($id);
        return response()->json(['data' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'event_date' => 'required',
            'type' => 'required',
        ]);
        $event = Event::find($id);
        $event->name = $request->name;
        $event->link = $request->link;
        $event->description = $request->description;
        $event->event_date = $request->event_date;
        $event->type = $request->type;
        $event->difficulty = $request->difficulty;
        $event->language = $request->language;
        $event->venue = $request->venue;
        $event->location = $request->location;
        $event->objectives = $request->objectives;
        $event->details = $request->details;
        $event->fees = $request->fees;

        $event->save();
        EventSpeaker::destroy($event->speakers->pluck('id')->toArray());
        foreach (json_decode($request->speakers, true) ?? [] as $speaker) {
            $item = new EventSpeaker();
            $item->event_id = $event->id;
            $item->name = $speaker['name'];
            $item->save();
        }
        return response()->json(['data' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(['success']);
    }
}
