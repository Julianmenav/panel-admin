<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Event;
use App\Models\EventType;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Traemos tambien la información de su tipo de evento.
        $events = Event::with('eventType')->get();
        $event_types = EventType::all();

        return view('adminHome', ['events' =>  $events, 'event_types' => $event_types]);
    }


    public function create(Request $request)
    {

        // dd($request->start_datetime);
        Event::create([
            'title'=> $request->title,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'event_type_id' => $request->event_type_id
        ]);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $event = Event::find($request->id);
        $event->title = $request->title;
        $event->event_type_id = intval($request->event_type_id);

        $event->save();
    }   


    public function delete(Request $request)
    {
        $event = Event::find($request->id);
        $event->delete();
    }
}
