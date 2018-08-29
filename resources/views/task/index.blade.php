@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>


<div class="row">
    <div class="col-md-6">
        <h1>ALL TASKS</h1>
    </div>

<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add New Tasks</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <form id="project_form" action="{{ route('task.store') }}" method="POST">
            {{ csrf_field() }}

          <h6 class="modal-title">Task Title</h6>
          <div class="form-group">
                <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter Title" name="task_title">
        </div>
                            
                        </div>
            <label>Add Task Files (png,gif,jpeg,jpg,txt,pdf,doc) <span class="glyphicon glyphicon-file" aria-hidden="true"></span></label>

            <div class="form-group">
            <input type="file" class="form-control" name="photos[]" multiple>
        </div>

        <div class="form-group">
            <textarea class="form-control my-editor" rows="3" id="task" name="task"></textarea>
        </div>

          <div class="col-md-10">
        <div class="form-group ">
            <label>Assign to Project <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span></label>
            <select name="project_id" class="form-control" data-style="btn-primary" style="width:100%;">
               @foreach( $projects as $project )
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                 @endforeach
            </select>
        </div>
    </div>
        <div class="col-md-10">
        <div class="form-group">
            <label>Assign to: <span class="glyphicon glyphicon-user" aria-hidden="true"></span></label>
            <select id="user" name="user" class="form-control" data-style="btn-info" style="width:100%;">
                @foreach ( $users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>Select Priority <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
            <select name="priority" class="form-control" data-style="btn-info" style="width:100%;">
              <option value="0">Normal</option>
              <option value="1">High</option>
            </select>
        </div>

        <div class="form-group">
            <label>Select Due Date <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='date' class="form-control" name="duedate">

                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="btn-group">
            <input class="btn btn-primary" type="submit" value="Submit" onclick="return validateForm()">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
        </div>

    </div>
                        <!--<h6 class="modal-title">Select Client</h6>-->

                </div>
        </div>
    </div>

</div>
</form>

</div>
</div>





<!--  END modal  -->

    <div class="col-md-6">

        <!-- search form (Optional) -->

      <form action="{{ route('task.search') }}" method="get" name="main_search_form" class="navbar-form">


        <div class="input-group">

            <input autocomplete="off" type="text" placeholder="Search Tasks" class="form-control col-md-6" name="task_search" id="task_search">
            <span class="input-group-btn">
            <button type="submit"  id="search-btn" class="btn btn-flat">Search<i class="fa fa-search"></i>
                        </button>
            </span>
        </div>


        </form>

    </div> 

</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
        <th>Due Date</th>
        <th><a href="{{ route('task.sort', [ 'key' => 'task' ]) }}">Task Title <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th>Assigned To</th>
        <th>Project</th>
        <th><a href="{{ route('task.sort', [ 'key' => 'priority' ]) }}">Priority <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th><a href="{{ route('task.sort', [ 'key' => 'completed' ]) }}">Status <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

@if ( !$tasks->isEmpty() ) 
    <tbody>
    @foreach ( $tasks as $task)
      <tr>
        <td>{{ Carbon\Carbon::parse($task->created_at)->format('m-d-Y') }}</td>
        <td>{{ Carbon\Carbon::parse($task->duedate)->format('m-d-Y') }}</td>
        <td>{{ $task->task_title }} </td>

        <td>
         
            @foreach( $users as $user) 
                @if ( $user->id == $task->user_id )
                    <a href="{{ route('user.list', [ 'id' => $user->id ]) }}">{{ $user->name }}</a>
                @endif
            @endforeach
        </td>
        <td>
            @foreach( $projects as $project)
                @if ($project->id == $task->project->id)
            {{--<span class="label label-jc">{{ $task->project->name }}</span>--}}
            <a href="{{ route('task.list', [ 'projectid' => $project->id ]) }}">{{ $project->name }}</a>
            
            @endif
            @endforeach
        </td>

        <td>
            @if ( $task->priority == 0 )
                <span class="label label-info">Normal</span>
            @else
                <span class="label label-danger">High</span>
            @endif
        </td>
        <td>
            @if ( !$task->completed )
                <a href="{{ route('task.completed', ['id' => $task->id]) }}" class="btn btn-warning"> Mark as completed</a>
                <span class="label label-danger">{{ ( $task->duedate < Carbon\Carbon::now() )  ? "!" : "" }}</span>
            @else
                <span class="label label-success">Completed</span>
            @endif
  
            

        </td>
        <td>
            <a href="{{ route('task.view', ['id' => $task->id]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"><i class="material-icons">pageview</i></span></a>
        </td>
        <td>
            <!-- <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary"> edit </a>  -->
            

            <a class="btn btn-danger" href="{{ route('task.delete', [ 'id' => $task->id ]) }}" Onclick="return ConfirmDelete();"><i class="material-icons">delete</i><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;


            
        </td>
      </tr>

    @endforeach
    </tbody>

    {{ $tasks->links() }}


@else 
    <p><em>There are no tasks assigned yet</em></p>
@endif


</table>
</div>

@stop

@section('scripts')
<!-- TYPE AHEAD LIB -->
<script src="{{ asset('js/typeahead.min.js') }}"></script>

<script>

$(document).ready(function() {
    $('#task_search').on('keyup', function(e){
        if(e.which == 13){
            $('#main_search_form').submit();
        }
    });
    $.get("/main-search-autocomplete", function(data){
        $("#task_search").typeahead({
            "items": "all", // Number of Items
            "source": data,
            "autoSelect": false,
            displayText: function(item){
                console.log('returning item: ' + item.task_title ) ;
                return item.task_title;
            },

            updater: function(item) {
              // http://laratubedemo.test/admin/videos/search?video_search=Code+Geass+Op1
                window.location.href = '{{ route('task.search') }}?task_search=' + item.task_title.split(' ').join('+') ;
            }

        });
    },'json');
});
function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a Project will also delete all tasks associated with this project");
  if (x)
      return true;
  else
    return false;
}



</script>


@stop--}}