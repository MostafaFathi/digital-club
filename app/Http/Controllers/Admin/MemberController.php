<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $members = Member::query();
        if (request()->has('q') and request()->get('q') != '') {
            $members = $members->where(function ($q) {
                $q->where('first_name', 'like', '%' . request()->get('q') . '%')
                    ->orwhere('last_name', 'like', '%' . request()->get('q') . '%')
                    ->orwhere('email', 'like', '%' . request()->get('q') . '%');
            });
        }
        if (request()->has('event_id') and request()->get('event_id') != '') {
            $members = $members->whereHas('events', function ($q) {
                $q->where('events.id', request()->get('event_id'));
            });
        }
        if (request()->has('limit') and request()->get('limit') != '') {
            $members = $members->limit(request()->get('limit'));
        }
        $members = $members->get();

        $events = !request()->filled('event_id') ? Event::all() : [];
        return response()->json(['data' => $members, 'events' => $events]);
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
            'first_name' => 'required'
        ]);
        $member = new Member();
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->email = $request->email;
        $member->postal_address = $request->postal_address;
        $member->profession = $request->profession;
        $member->save();
        return response()->json(['data' => $member]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $member = Member::with('events')->find($id);
        return response()->json(['data' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $member = Member::with('events')->find($id);
        return response()->json(['data' => $member]);
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
            'first_name' => 'required'
        ]);
        $member = Member::find($id);
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->email = $request->email;
        $member->postal_address = $request->postal_address;
        $member->profession = $request->profession;
        $member->save();
        return response()->json(['data' => $member]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return response()->json(['success']);
    }
}
