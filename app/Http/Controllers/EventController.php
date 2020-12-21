<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use Calendar;
use Carbon\Carbon;
use Auth;
use App\Bitacora;
use App\User;

class EventController extends Controller
{
    
    public function calendar()
            {
                $events = [];
                //$data = Event::all();
                $data = Event::where('creator', Auth::id())->orWhere('type','Global')->get();
                if($data->count())
                 {
                    foreach ($data as $key => $value) 
                    {
                        if($value->type == 'Global'){

                            $color = '#a3bcc9';
                        } else {

                            $color = '#25db5c';
                        }
                        
                        $events[] = Calendar::event(
                            $value->title,
                            true,
                            new \DateTime($value->start),
                            new \DateTime($value->end.'+1 day'),
                            null,
                            // Add color
                         [
                             'color' => $color,
                             'textColor' => '#000000',
                         ]
                        );
                    }
                }
                $calendar = Calendar::addEvents($events);
                return view('event.index', compact('calendar'));
            }
    
    
    public function createEvent()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $event= new Event();
        $event->title=$request->title;
        $event->start= substr($request->start,0,10);
        $event->end= substr($request->end,0,10);
        $event->creator = Auth::id();
        $event->type = $request->type;
        $event->save();


        $bitacora = new Bitacora;
        $bitacora->user_id = Auth::id();
        $consulta = User::where('id',Auth::id())->select("nombres","apellidos","rolprimario","rolsecundario")->get();
        foreach($consulta as $item){
            $nombres = $item->nombres;
            $apellidos = $item->apellidos;
            $rolprimario = $item->rolprimario;
            $rolsecundario = $item->rolsecundario;
        }
        
        $bitacora->usuario = $nombres." ".$apellidos;
        $bitacora->rol = $rolprimario.", ".$rolsecundario;
        $bitacora->fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $bitacora->hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $bitacora->accion = "Registrado evento";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();




        //return redirect('event')->with('success', 'Event has been added');
        return redirect('event');
    }

    public function list(){
        //$datos['eventos']=Event::all();
        $datos['eventos']=Event::where('creator', Auth::id())->orWhere('type','Global')->get();
        return view('event.list', $datos);

    }

    public function edit($id)
    {
        $evento = Event::findOrFail($id);

        return view('event.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        $datosEvento=request()->except(['_token','_method']);
        //$datosEvento->start = substr($datosEvento->start,0,10);
        //$datosEvento->end = substr($datosEvento->end,0,10);

        Event::where('id','=',$id)->update($datosEvento);


        $bitacora = new Bitacora;
        $bitacora->user_id = Auth::id();
        $consulta = User::where('id',Auth::id())->select("nombres","apellidos","rolprimario","rolsecundario")->get();
        foreach($consulta as $item){
            $nombres = $item->nombres;
            $apellidos = $item->apellidos;
            $rolprimario = $item->rolprimario;
            $rolsecundario = $item->rolsecundario;
        }
        
        $bitacora->usuario = $nombres." ".$apellidos;
        $bitacora->rol = $rolprimario.", ".$rolsecundario;
        $bitacora->fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $bitacora->hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $bitacora->accion = "Evento modificado";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();




        return redirect('event');
    }

    public function destroy(Request $request, $id){
        Event::destroy($id);

        $bitacora = new Bitacora;
        $bitacora->user_id = Auth::id();
        $consulta = User::where('id',Auth::id())->select("nombres","apellidos","rolprimario","rolsecundario")->get();
        foreach($consulta as $item){
            $nombres = $item->nombres;
            $apellidos = $item->apellidos;
            $rolprimario = $item->rolprimario;
            $rolsecundario = $item->rolsecundario;
        }
        
        $bitacora->usuario = $nombres." ".$apellidos;
        $bitacora->rol = $rolprimario.", ".$rolsecundario;
        $bitacora->fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $bitacora->hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $bitacora->accion = "Evento eliminado";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('event');

    }

    
}
