<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use Calendar;

class EventController extends Controller
{
    
    public function calendar()
            {
                $events = [];
                $data = Event::all();
                if($data->count())
                 {
                    foreach ($data as $key => $value) 
                    {
                        $events[] = Calendar::event(
                            $value->title,
                            true,
                            new \DateTime($value->start_date),
                            new \DateTime($value->end_date.'+1 day'),
                            null,
                            // Add color
                         [
                             'color' => '#a3bcc9',
                             'textColor' => '#000000',
                         ]
                        );
                    }
                }
                $calendar = Calendar::addEvents($events);
                return view('fullcalendar.index', compact('calendar'));
            }
    
    
    public function createEvent()
    {
        return view('fullcalendar.create');
    }

    public function store(Request $request)
    {
        $event= new Event();
        $event->title=$request->get('title');
        $event->start_date=$request->get('startdate');
        $event->end_date=$request->get('enddate');
        $event->save();
        //return redirect('event')->with('success', 'Event has been added');
        return redirect('event');
    }

    public function list(){
        $datos['eventos']=Event::all();
        return view('fullcalendar.list', $datos);

    }

    public function edit($id)
    {
        $evento = Event::findOrFail($id);

        return view('fullcalendar.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        $datosEvento=request()->except(['_token','_method']);
        Evento::where('id','=',$id)->update($datosEvento);

        return redirect('event');
    }

    
}
