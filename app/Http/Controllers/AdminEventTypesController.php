<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EventType;

class AdminEventTypesController extends Controller
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
        $eventTypesPag = DB::table('event_types')->paginate(10);

        return view('adminEventTypes', ['eventTypesPag' => $eventTypesPag]);
    }

    public function create(Request $request)
    {
        EventType::create([
            'name' => $request->name,
            'backgroundColor' => $request->backgroundColor,
            'borderColor' => $request->borderColor,
            'textColor' => $request->textColor
        ]);
        
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $type = EventType::find($request->id);
        return json_encode($type);
    }

    public function update(Request $request)
    {
        $type = EventType::find($request->id);

        $type->name = $request->name;
        $type->backgroundColor = $request->backgroundColor;
        $type->borderColor = $request->borderColor;
        $type->textColor = $request->textColor;
        $type->save();
    }

    public function delete(Request $request)
    {
        $type = EventType::find($request->id);
        $type->delete();
    }
}
