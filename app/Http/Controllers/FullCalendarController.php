<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Event;
use Redirect,Response;
use Calendar;

class FullCalendarController extends Controller
{
    public function index()
    {
        $events = [];
        $data = Event::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->title,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.' +1 day'),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#f05050',
	                    'url' => 'pass here url and any route',
	                ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('fullcalendar.index', compact('calendar'));
    }
    
    public function create(Request $request){
        $insertArr = [ 'title' => $request->title,'start' => $request->start,'end' => $request->end];
        $event = Event::insert($insertArr);

        return Response::json($event);
    }
    public function update(Request $request){
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
        return Response::json($event);
    }
    public function destroy(Request $request){$event = Event::where('id',$request->id)->delete();
        return Response::json($event);
    }
}
