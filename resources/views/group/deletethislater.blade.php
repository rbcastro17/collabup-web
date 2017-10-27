@extends('master')

@section('title')
Group
@endsection

@section('content')
<script>
$(document).ready(function(){
    $('#modal_form_vertical').on('show.bs.modal', function (e) {
        var designid = $(e.relatedTarget).data('designid'); //get the id
        alert(designid);
        var dataString = 'designid=' + designid;
        $.ajax({
            type: "POST",
            url: "includes/design_content.php",
            data: dataString,
            cache: false,
            success: function(data){
                $('.ui.basic.modal')
                 .modal('show')
                ;
               // $("#designcontent").html(data);
            }
        });
     });
});
</script>

<h2 class="ui header">
    <i class="users icon"></i>
        <div class="content">
            Groups
            <div class="sub header">More the fun</div>
        </div>
</h2>
@if(Auth::user()->role = 2)

<a href="{{route('group.create')}}" data-tooltip="Create a Group" class="right ui blue button"><i class="users icon"></i> Create Group</a>
<div class="ui horizontal divider">Groups</div>
<div class="ui two column doubling stackable grid container"> 
@if($groups->count() > 0)
		<div class="row">
    @foreach($groups as $group)
    <div class="ui card">
                <div class="content">
                    <div class="header"><i class="users green icon"></i> {{$group->group_name}}</div>
                </div>
                <div class="content" >
                    <h3 class="ui sub header" data-tooltip="{{$group->description}}">{{str_limit($group->description, 50)}}</h3>
                </div>
                <div class="extra content">
<a href="{{route('group.show', $group->id)}}" class="ui blue button">View</a>
<a href="{{route('group.destroy',$group->id)}}" class="ui red button" data-tooltip="Delete this Group?"><i class="trash icon"></i></a>
<a href="{{route('group.edit',$group->id)}}" class="ui violet button" data-tooltip="Edit this Group?"><i class="write icon"></i></a>
                </div>
    </div>      
    @endforeach

</div>


<center>{{$groups->links()}}</center>
</div>
    @else
<h3 class="text-center">No groups found.</h3>
    @endif
@else

    <h3>Request in joining a group or Ask for an invite</h3>
    <h4>No groups yet</h4>

@endif


@endsection