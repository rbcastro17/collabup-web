<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Event;
use App\Member;
use Carbon\Carbon;
use FullCalendar;
use Auth;

class EventController extends Controller
{
public function index(){
    if(Auth::user()->role == 2 ){
   $calendar = new \Edofre\FullcalendarScheduler\FullcalendarScheduler();
    $groups = Event::where('event_author', Auth::user()->id)->get();
    $group = Group::where('group_owner', Auth::user()->id)->get();
    $arraygroup = array();
    $option_group = array();
    $event_list = array();


    foreach($groups as $event){
        array_push($arraygroup, array(
            "id" => $event->ref,
            "title" => $event->group->group_name
        ));
        array_push($event_list, array(
            "id" => $event->id,
            "resourceId" => $event->ref,
            "start" => $event->start_duration,
            "end" => $event->end_duration,
            "title" => $event->title
        ));
    }

    $calendar->setEvents($event_list);
    
    // $calendar->setResources(route('fullcalendar-scheduler-ajax-resources'));
   $calendar->setResources($arraygroup);

    // Set options
    $calendar->setOptions([
        'now'               =>  date('Y-m-d'),
        'editable'          => true, // enable draggable events
        'aspectRatio'       => 2.0,
        'scrollTime'        => '00:00', // undo default 6am scrollTime
        'defaultView'       => 'timelineMonth',
        'views'             => [
            'timelineThreeDays' => [
                'type'     => 'timeline',
                'duration' => [
                    'days' => 3,
                ],
            ],
        ],
        'resourceLabelText' => 'Groups',
        'eventClick' => new \Edofre\FullcalendarScheduler\JsExpression("
                    function(event, jsEvent, view) {
                        console.log(event);
                    }
                "),
                'viewRender' => new \Edofre\FullcalendarScheduler\JsExpression("
                    function( view, element ) {
                        console.log(\"View \"+view.name+\" rendered\");
                    }
                "),
    ]);
    $data['calendar'] = $calendar;
    $data['groups'] = $group;
    $data['events'] = $groups;

    return view('calendar.index',$data);
    }
    else{
    //If Auth user is a member
    $calendar = new \Edofre\FullcalendarScheduler\FullcalendarScheduler();

    $groups_for_member = Member::where('user_id', Auth::user()->id)->get();
    

    $event_list = array();
    $arraygroup = array();
    $event_list_out = array();
    foreach($groups_for_member as $group_member){
        $groups = Group::where('id', $group_member->group_id)->get();
        
        foreach($groups as $event_g){

              $events = Event::where('group_id', $event_g->id)->get();     
              foreach($events as $event){
        array_push($arraygroup, array(
            "id" => $event->ref,
            "title" => $event->group->group_name
        ));
                    array_push($event_list, array(
                            "id" => $event->id,
                            "resourceId" => $event->ref,
                            "start" => $event->start_duration,
                            "end" => $event->end_duration,
                            "title" => $event->title
                            ));
                    array_push($event_list_out, array(
                            "id" => $event->id,
                            "group_id" => $event->group,
                            "group_name" => $event->group->group_name,
                            "title" => $event->title,
                            "body" => $event->body,
                            "start_duration" => $event->start_duration,
                            "end_duration" => $event->start_duration
                            ));          
              }
                   
          
            }
        }
   //     dd($arraygroup);
    $calendar->setEvents($event_list);
    
    // $calendar->setResources(route('fullcalendar-scheduler-ajax-resources'));
   $calendar->setResources($arraygroup);

    // Set options
    $calendar->setOptions([
        'now'               =>  date('Y-m-d'),
        'editable'          => true, // enable draggable events
        'aspectRatio'       => 2.0,
        'scrollTime'        => '00:00', // undo default 6am scrollTime
        'defaultView'       => 'timelineMonth',
        'views'             => [
            'timelineThreeDays' => [
                'type'     => 'timeline',
                'duration' => [
                    'days' => 3,
                ],
            ],
        ],
        'resourceLabelText' => 'Groups',
        'eventClick' => new \Edofre\FullcalendarScheduler\JsExpression("
                    function(event, jsEvent, view) {
                        console.log(event);
                    }
                "),
                'viewRender' => new \Edofre\FullcalendarScheduler\JsExpression("
                    function( view, element ) {
                        console.log(\"View \"+view.name+\" rendered\");
                    }
                "),
    ]);
        //dd($events);
        $data['events'] = $event_list_out; 
        $data['calendar'] = $calendar;
        return view('calendar.memberindex',$data);
    }
 
}

public function store(Request $request){

   $event = [
       'group_id' => $request->group,
       'event_author' => Auth::user()->id,
       'group_id' => $request->group,
       'start_duration' => $request->start_date,
       'end_duration' => $request->end_date,
       'title' => $request->title,
       'body' => $request->body,
       'ref' => str_random(50)
   ];
   Event::create($event);
   
   return redirect("/calendar");
}

public function edit($id){
     $event = Event::find($id);

        return view('calendar.edit', ['event' => $event]);

}
public function update(Request $request){
    $update = [
        "start_duration" => $request->start,
        "end_duration" => $request->end,
        "body" => $request->body,
        "title" => $request->title    
    ];
    Event::where('id',$request->id)->update($update);
    return redirect()->back();
}

public function destroy($id){
Event::where('id',$id)->delete();
return redirect()->back();
}

    }
