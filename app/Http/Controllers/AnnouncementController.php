<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Announcement;

use Auth;

use App\AuditTrail;

use App\Events\SendAppNotification;

use Illuminate\Support\Facades\DB;

use App\User;

use App\AppNotification;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\
     */
    public function index()
    { 
	$data['ann'] = DB::table('announcement')->get();
      //dd($data);
        return view('admin.announcement',$data);
		
		
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['ann'] = Announcement::all();
        
       // return view('admin.announcement',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ref = str_random(6); 
        $ann = new Announcement; 
		$ann->user_id = Auth::id();
        $ann->title = $request->title;                                                                        
		$ann->body = $request->body;
        $ann->ref = $ref;
    	$ann->save();
      
      AuditTrail::create(
        ['user_id' => Auth::id(),
        'description' => Auth::user()->first_name." Created an announcement",
        'url' => route('audit.show.announcement', $ref) 
        ]
      );

     $users = User::where([['role', '!=', 3], ['active', '=', true]])->get();

     // dd($users);
      foreach($users as $u){
        AppNotification::create([
            'user_id' => Auth::user()->id,
            'reciever_id' => $u->id,
            'ref' => $ref,
            'group_id' => 0,
            'type' => 3
        ]);

        event(new SendAppNotification(Auth::user()->id, $u->id, $ref, 0,3));
      }


      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /*
	 *
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
     */
    public function edit($id)
    {
        $data['a'] =Announcement::where('id', $id)->first();
        
        return view('admin.editannouncement',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		
        $ann = Announcement::find($id);
        $ann->title = $request->title; 
        $ann->body = $request->body;
        $ann->save();
        
        return redirect('announcements');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ann = Announcement::find($id);
        $ann->delete();
        return redirect()->back();
    }
}
