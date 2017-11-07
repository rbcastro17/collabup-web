<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use Auth;
class AdminController extends Controller
{
    public function __construct(){
		$this->middleware('admin'); //All methods in this controller are now protected. Users bellow admin will be prohibitted
	}
	public function index()
	{  
		return view('admin.index');
	}
        public function addAdminPage(){
            return view('admin.addAdmin');
        }
        public function addAdmin(Request $request){
             $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 3,
            'code' => str_random(10),
            'active' => true,
        ]);

        return redirect('ViewAdmins');
        }
        public function viewHeadUsers(){
            $data['users']= DB::table('users')->where ('role', 2)->get();
            return view ('admin.viewHeadUsers',$data);
        }
         public function viewAdmins(){
            $data['users']= User::where([['role','=', 3 ], ['id','!=', Auth::user()->id ]])->get();
            return view ('admin.ViewAdmins',$data);
        }
        public function viewprofile($id) {
                $user = DB::table('users')->where('id', $id)->first();
            $groups;

            if($user->role == 2){
                $groups = DB::table('groups')->where('group_owner', '=', $id)->get();
            }
            $posts = DB::table('posts')->where('user_id', '=', $id)->get();
            $files = DB::table('files')->where('file_owner', '=', $id)->get();
            
            $data['user'] = $user;
            $data['post_count'] = $posts->count();
            $data['file_count'] = $files->count();
            $data['group_count'] = $groups->count();
            return view('admin.viewuser',$data);
        }
        public function activate($id){
            DB::table('users')
            ->where('id', $id)
            ->update(['active' => 1]);
            return redirect()->back();
        }
        public function deactivate($id){
            DB::table('users')
            ->where('id', $id)
            ->update(['active' => 0]);
         return redirect()->back();
            }
        public function searchspecificuser(Request $request){
            
            $search = $request->search;
            $data['query'] = $search;
            $data['results'] = User::where('first_name', 'LIKE', '%'.$search.'%')->get();

            return view('admin.usersearchresult',$data);
        }    

	public function AnnouncementPage(){
		return view ('admin.announcement');
    }
    
       public function announcement(Request $request){
        $this->validate($request, ['body' => 'required|max:1000']);
        
            Post::create([
                'body' => $request->body,
                'user_id' => Auth::user()->id
            ]);
        
        return redirect()->back();
    }

    public function post($id)
    {
        $post = Post::find($id);
        $comment = Comment ::where('post_id',$id)->get();
        return view('group.post');
    }
	public function allusers(){
    $data['users'] = User::where('role', '!=', 3)->paginate(20);
    return view('admin.allusers', $data);
	}
	public function viewreportlists(){
	$data['reports'] = Reports::all();
	
	return view('admin.viewreports', $data);
    }
    public function disregardpost(){
        
    }

	public function deletepost($id){
	//Report = 

    }
    

    public function storecategory(Request $request){
        $this->validate($request,[
            'category_name' => 'required|max:50',
            'category_description' => 'required|max:200'
        ]);
            $ref = str_random(12);
        Category::create([
            'name' => $request->category_name,
            'description' => $request->category_description,
            'author_id' => Auth::user()->id,
            'ref' => $ref
        ]);
            return redirect()->back();
    }

	public function deletecategory($id){
	Category::where('id', $id)->delete();
	return redirect()->back();
	}

    
}