<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test/registerpage', function(){
return view('auth.register');    
});


Route::get('upload/onedrive', 'GroupController@fromfolder')->name('onedrive.page');

Route::post('save/fromonedrive', 'GroupController@saveonedrive')->name('upload.file.onedrive');

Route::get('/', function () {
    if(Auth::check()){
    	return redirect()->route('dashboard');
    }else{
    return view('welcome');
    }
})->name('landing');

Route::get('testthis', function(){

    return "connected";
});

Route::post('mobile/addpost', 'MobileController@addpost');

Route::post('mobile/getactivities/own', 'MobileController@getownactivities');

Route::get('mobile/announcement', 'MobileController@fetchannouncement');

Route::post('mobile/announcement/one', 'MobileController@fetchoneannouncement');

Route::get('mobile/getallgroups', 'MobileController@getallgroups');

Route::get('mobile/admin/getaudit', 'MobileController@getaudit');

Route::post('mobile/login', 'MobileController@login');

Route::post('mobile/register', 'MobileController@register');

Route::post('mobile/activate/account', 'MobileController@activateuser');

Route::post('mobile/sendforget', 'MobileController@sendforgetcode');

Route::post('mobile/changepassword', 'MobileController@changepassword');

Route::post('mobile/changeinpassword', 'MobileController@changeinpassword');

Route::get('mobile/admin/alladmins', function(){
	$admins = App\User::where("role", "=",3)->get();
	$res = [];
	foreach($admins as $admin){
	array_push($res,[
	"first_name" => $admin->first_name,
	"middle_name" => $admin->middle_name,
	"last_name" => $admin->last_name,
	"email" => $admin->email,
	"active" => $admin->active,
	"role" => $admin->role 
	]);	
}
	return ['result'=>$res];

});

Route::post('mobile/admin/login', 'AdminMobileController@login');

Route::get('mobile/admin/getusers', 'AdminMobileController@alluser');

Route::post('mobile/admin/activateuser', 'AdminMobileController@activateuser');

Route::post('mobile/admin/deactivateuser', 'AdminMobileController@deactivate');

Route::post('mobile/admin/addannouncement','AdminMobileController@addannouncement');

Route::post('mobile/getgroupactivities', 'MobileController@getactivities');

Route::post('mobile/admin/updateannouncement', 'AdminMobileController@updateannouncement');

Route::post('mobile/admin/deleteannouncement', 'AdminMobileController@deleteannouncement');

Route::post('mobile/getgroups', 'MobileController@getallgroups');

Route::post('mobile/fetchpost', 'MobileController@fetchpost');

Route::post('mobile/fetchcomment', 'MobileController@fetchcomments');

Route::post('mobile/fetchmembers', 'MobileController@fetchmembers');

Route::get('mobile/fetchfolders', 'MobileController@fetchfolders');

Route::post('mobile/addcomment', 'MobileController@addComment');

Route::post('mobile/fetchfiles', 'MobileController@fetchfiles');

Route::get('account/{id}/activate', 'AdminController@activate')->name('account.activate.admin');

Route::get('account/{id}/deactivate', 'AdminController@deactivate')->name('account.deactivate.admin');

Route::get('account/search', 'AdminController@searchspecificuser');

Route::get('/dashboard', function(){
    
return view('dashboard');
})->name('dashboard')->middleware('verified');

Route::get('/signup', 'AuthController@getRegister')->name('register');

Route::get('/signin', 'AuthController@getLogin')->name('login');

Route::post('/signup', 'AuthController@register')->name('auth.register');

Route::post('/signin', 'AuthController@login')->name('auth.login');

Route::get('reset', 'UserController@resetpage')->name('resetpage');

Route::put('reset', 'UserController@resetinpassword')->name('reset.in');

//Route::put('resetpassword/', 'UserController@resetpassword')->name('resetpassword');

Route::get('resetpasswordout/{token}', 'UserController@resetoutpasswordpage')->name('resetout.page');

Route::post('resetpassword/out/', 'UserController@resetoutpassword')->name('resetpassword.out');

Route::get('/logout', 'AuthController@logout')->name('logout');

Route::post('sendcode', 'AuthController@sendcode')->name('sendforgetcode');

//User
Route::get('profile/edit', 'UserController@edit_profile')->name('account.edit');

Route::put('profile/edit', 'UserController@update_profile')->name('account.update');

Route::get('account/{code}/', 'UserController@activateuser')->name('activate');

Route::get('announcements', 'UserController@showannouncements')->name('current.announcement');
//Misc

Route::get('allusers', 'AdminController@allusers')->name('all.users');


Route::get('result', 'GroupController@showsearchresult');

Route::get('request/{group_id}', 'UserController@requestJoinGroup')->name('request');

Route::get('request/{group_id}/cancel', 'UserController@cancelrequest')->name('request.cancel');

Route::get('requests/{id}', 'GroupController@memberrequests')->name('requests');

Route::post('message', function(Request $request) {

    $user = Auth::user();

    $message = ChatMessage::create([
        'user_id' => $user->id,
        'message' => $request->input('message')
    ]);

    (new ChatMessageWasReceived($message, $user));


});

Route::get('chat/', function(){

		return view('home');
});




//Audit Trail Routes

Route::get('audit', 'AuditController@index')->name('audit.index');

Route::get('audit/{ref}/announcement', 'AuditController@showannouncement')->name('audit.show.announcement');

Route::get('ann/destroy/{id}', 'AnnouncementController@destroy')->name('ann.destroy');

Route::get('announcement/{id}/delete', 'AnnouncementController@delete')->name('ann.delete');

Route::get('announcement/{id}/edit', 'AnnouncementController@edit')->name('ann.edit');

Route::get('admin/dashboard', 'AdminController@index')->name('admin.index');

Route::get('addAdminPage', 'AdminController@addAdminPage')->name('addAdminPage');

Route::post('addAdmin', 'AdminController@addAdmin')->name('addAdmin');

Route::get('viewprofile/{id}', 'AdminController@viewprofile')->name('view.profile');

Route::get('act/{id}', 'AdminController@activate')->name('user.activate');

Route::get('deact/{id}', 'AdminController@deactivate')->name('user.deactivate');

Route::get('viewHeadUsers', 'AdminController@viewHeadUsers')->name('viewHeadUsers');

Route::get('ViewAdmins', 'AdminController@viewAdmins')->name('ViewAdmins');

Route::post('admin/announcement/create', 'AnnouncementController@store')->name('create.announcement');

Route::resource('announcement', 'AnnouncementController');

Route::get('admin/edit', 'UserController@edit_profile')->name('admin.edit');

Route::put('admin/{id}/edit', 'UserController@update_profile')->name('admin.update');

Route::get('categories', function(){
    $data['categorys'] = App\Category::orderBy('name', 'asc')->get();
    return view('admin.category',$data);

})->middleware('admin');

//User

Route::get('profile/', 'UserController@showprofile');

Route::get('profile/{id}', 'GroupController@viewmemberprofile')->name('group.member.profile');

Route::get('folder/{id}/{group_id}/edit', 'GroupController@editFolderPage')->name('folder.edit');

Route::put('folder/update', 'GroupController@updatefolder')->name('update.folder');
Route::get('folder/{id}/delete', 'GroupController@deletefolder')->name('delete.folder');

Route::get('createFolderPage/{id}', 'GroupController@createFolderPage')->name('create.folder');

Route::post('createFolder/{id}', 'GroupController@createFolder')->name('do.folder');

Route::post('createFolder', 'GroupController@createFolder')->name('do.folder.notroot');

Route::get('folder/{id}', 'GroupController@showFolder')->name('folder.specific');

Route::post('upload/{id}', 'GroupController@savelink')->name('upload.file');

Route::get('members/list/{id}', 'GroupController@getmembers')->name('members');
//testing zone

Route::get('send/dummy', 'MobileController@test_send');


//Groups

Route::get('edit/{id}/status/{group_id}', 'GroupController@editstatuspage')->name('status.edit');

Route::put('edit/status', 'GroupController@updatestatus')->name('status.update');

Route::get('delete/{id}/status', 'GroupController@deletestatus')->name('status.delete');

Route::get('groups', 'GroupController@index')->name('groups');

Route::get('group/create', 'GroupController@create')->name('group.create');

Route::post('group/create', 'GroupController@store')->name('group.store');

Route::get('group/{id}', 'GroupController@show')->name('group.show');

Route::get('groups/{id}/destroy', 'GroupController@destroy')->name('group.destroy');

Route::get('groups/{id}/edit', 'GroupController@edit')->name('group.edit');

Route::put('groups/{id}/edit', 'GroupController@update')->name('group.update');

Route::post('group/{id}', 'PostController@create')->name('post.create');

Route::post('group/{id}/{post}', 'CommentController@comment')->name('comment');

Route::get('group/{id}/events', 'EventController@index')->name('event');

Route::get('group/{id}/events/list', 'EventController@list')->name('event.list');

Route::post('group/{id}/events/create', 'EventController@add_event')->name('event.create');

Route::get('event/{id}/delete', 'EventController@destroy')->name('event.delete');

Route::get('event/{id}/edit', 'EventController@edit')->name('event.editpage');

Route::put('event/{id}/update', 'EventController@update')->name('event.update');

Route::get('dashboard/upgrade', 'UserController@account_upgrade')->name('upgrade');

Route::get('group/{id}/invite', 'GroupController@invite_members')->name('invite');

Route::post('/group/{id}/send/{code}', 'GroupController@send_invite')->name('invite.send');

Route::get('accept/{id}/{email}', 'GroupController@invite')->name('invite.active');

Route::put('dashboard/{id}/upload', 'UserController@upload_picture')->name('account.avatar');

Route::get('confirm/test', 'UserController@test_send');

Route::get('group/{group_request}/accept','GroupController@acceptrequest')->name('group.accept');

Route::get('group/{group_request}/delete','GroupController@deleterequest')->name('group.decline');

Route::get('search/members/', 'GroupController@showsearchmemberresult')->name('search.group.member');

Route::get('member/{id}/delete', 'GroupController@deletemember')->name('member.delete');

//Mobile

Route::post('mobile/login/chat', 'MobileController@chatlogin');

Route::post('mobile/getgroups/chat', 'MobileController@getgroupschat');

Route::post('mobile/setok', 'MobileController@hasChat');

//---------------------------------------------------------


//----------------------------------------------------------------------------------------
Route::get('doChange/{code}', 'UserController@forget_password');

Route::get('forgetpassword', 'UserController@forgetpage');

Route::get('get_unread', function(){
       return Auth::user()->unreadNotifications;
   });
   Route::get('/notifications', [
       'uses' => 'UserController@notifications',
       'as' => 'notifications'
   ]);
Route::get('file/delete/{id}', 'GroupController@deletefile')->name('delete.file');

Route::get('search/', function(){
//echo "nothing";
return view('group.searchpage');
});
Route::get('test', function () {
    event(new App\Events\Posted('Someone', 1, "Rafael's Group",2, 'http://facebook.com'));
    return "Post Event has been sent!";
});

Route::get('testevent', function () {
 event(new App\Events\Posted('Someone', 2, "Rafael's Group"));
    return "Event has been sent!";
});

Route::get('testannouncement', function () {
    event(new App\Events\Posted("Admin", 3, 'none'));
    return "Announcement has been sent!";
});

Route::get('calendar', 'EventController@index');

Route::post('event/create', 'EventController@store')->name('event.store');

Route::get('debug/raffypogi', 'AdminController@debugroute');

Route::post('store/category', 'AdminController@storecategory');

Route::get('discover/category', 'GroupController@discoverbycategorypage');

Route::get('discover/result', 'GroupController@discoverbycategory');

Route::get('delete/{id}/category', 'AdminController@deletecategory')->name('delete.category');

Route::post('mobile/admin/fetchuserinfo', 'AdminMobileController@fetchuserinfo');

Route::get('chatroom', 'GroupController@group_chat');

Route::get('notifications', 'UserController@notificationpage');

Route::get('notification/post', 'UserController@readpostnotification');

Route::get('notification/event', 'UserController@readeventnotification');

Route::get('notification/announcement', 'UserController@readannouncementnotification');

Route::get('notification/file', 'UserController@readfilenotification');

Route::post('delete/admin/user', 'AdminController@deleteadmin')->name('delete.admin');

Route::get('about', function(){
    return view('about');
});

Route::post('read');

Route::post('readallnotification', 'UserController@readAllNotification');

Route::post('mobile/addgroup', 'MobileController@addgroup');

Route::get('mobile/fetchcategories', 'MobileController@fetchcategories');

Route::post('mobile/updategroup', 'MobileController@updategroup');

Route::post('mobile/deletegroup', 'MobileController@deletegroup');

Route::post('mobile/addevent', 'MobileController@addevent');

Route::post('mobile/editevent', 'MobileController@editevent');

Route::post('mobile/deleteevent', 'MobileController@deleteevent');

Route::get('mobile/fetchevent', 'MobileController@fetchevent');

Route::get('mobile/fetchevents', 'MobileController@fetchevents');

Route::post('mobile/requestjoingroup', 'MobileController@requestjoingroup');

Route::post('mobile/fetcheventmember', 'MobileController@fetcheventmember');

Route::post('mobile/fetcheventhead', 'MobileController@fetcheventhead');

//Route::post();

