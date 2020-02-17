<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    //
    public function index()
    {
    	$events = \App\Events::all();

    	return view("events.index", ['events' =>  $events]);
    }


    public function initialEvents()
    {
    	$events = \App\Events::all();

    	$eventnew = array();

    	foreach ($events as $e)
		{
		    array_push( $eventnew, array(

		    	'title' => $e->event_name,
		    	'start' => $e->start_date,
		    	'end' => $e->end_date,

		    ) );
		}
    	return $eventnew;
    	
    }


    public function addEvent(Request $request)
    {	


    		$req = request('request_data');
    		$narray = array();

    		\App\Events::truncate();

    		
    		foreach( $req as $rq ){

    			$event = new \App\Events();

    			$event->event_name = $rq['title'];
    			$event->start_date = $rq['start'];
    			$event->end_date = $rq['end'];
    			$event->save();

    			array_push( $narray, array(
    				'event_name' => $rq['title'],
    				'start_date' => $rq['start'],
    				'end_date' => $rq['end'],
    			) );

    		}



    		return response()->json( [ 'result'=> $narray ] );

    	
    }




    public function deleteEvent(Request $request)
    {	
    
    	$events = \App\Events::all();
    	foreach($events as $e)
		{
			$e->delete();

		}
    	return response()->json( [ 'result'=> 'deleted' ] );

    	
    }



}
