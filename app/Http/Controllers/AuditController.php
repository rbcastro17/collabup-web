<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AuditTrail;

use App\Announcement;

class AuditController extends Controller
{
    public function __construct(){

     //   $this->middleware('admin');
    }

    public function index(){
        $data['audits'] = AuditTrail::Paginate(20);
   
   return view('admin.audittrail',$data);
   
    }

    public function showannouncement($ref){
        $data['ann'] = Announcement::where('ref', $ref)->first();
        
        return view('audit.announcement', $data);
    }

    
}
