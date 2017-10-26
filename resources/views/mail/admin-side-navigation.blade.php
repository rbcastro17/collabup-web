<div class="ui vertical menu">
    <div class="menu">
        <div class="item">
            <div class="header">Announcement</div>
            <div class="menu">
            
                    <a href="{{route('addAdminPage')}}" class="item"><i class="users icon"></i> Create Announcement</a>
                   
                    <a href="{{route('announcement')}}" class="item"><i class="users icon"></i> Display Announcement</a>
              
                    
            </div>
        </div>
        <div class="item">
            <div class="header">Manage Accounts</div>
            <div class="menu">
                <a href="{{route('addAdminPage')}}" class="item">Add Admin</a>
                <a href="{{route('viewHeadUsers')}}" class="item">List of Head Users</a>
                <a href="{{route('ViewAdmins')}}" class="item">List of Admins</a>
            </div>
        </div>
       
       
    </div>
</div>
