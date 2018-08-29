@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">


<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
<body class="bg-light">
<main role="main" class="container">
  <div class="border border-success card-block bg-faded">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
      <div class="row">
        <!--<div class="col-xs-12 col-sm-6 col-md-12">-->

 
      <div class="card-panel teal">
    <div class="col-md-9 col-lg-9 col-sm-9 card-block bg-faded">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <h1><span class="card-title">Projects</span></h1>
          <h4 class="mb-0 text-black lh-100">{{ $project->name }}</h4>
                <p> {{ $project->description }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>






       

      <!--<a href="/tasks/create" class="pull-right btn btn-secondary btn-md">Add Tasks</a>
          <div class="new_project">-->
  

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

          <h6 class="modal-title">Enter Task Title</h6>
          <div class="form-group">
                <div class="form-group">
            <input type="text" class="form-control" placeholder="enter title" name="task_title">
        </div>
                            
                        </div>
            <label>Add Task Files (png,gif,jpeg,jpg,txt,pdf,doc) <span class="glyphicon glyphicon-file" aria-hidden="true"></span></label>

            <div class="form-group">
            <input type="file" class="form-control" name="photos[]" multiple>
        </div>

        <div class="form-group">
          <p class="modal-title">Description</p>
            <textarea class="form-control my-editor" rows="3" id="task" name="task"></textarea>
        </div>

          <div class="col-md-12">
        <div class="form-group ">
            <p>Assign to Project <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span></p>
            <select name="project_id" class="form-control" data-style="btn-primary" style="width:100%;">
               @foreach( $project as $projects )
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                 @endforeach
            </select>
        </div>

        <div class="form-group">
            <p>Assign to: <span class="glyphicon glyphicon-user" aria-hidden="true"></span></p>
            <select id="user" name="user" class="form-control" data-style="btn-info" style="width:100%;">
                @foreach ( $users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            </p>Select Priority <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></p>
            <select name="priority" class="form-control" data-style="btn-info" style="width:100%;">
              <option value="0">Normal</option>
              <option value="1">High</option>
            </select>
        </div>

        <div class="form-group">
            </p>Select Due Date <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></p>
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

        
        </form>
      </div>

    </div>

  </div>
</div>
<!--  END modal  -->
<h6>Display Comments</h6>
<!--show Comments-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body"> 
                  @if ( !$projects->isEmpty() )

                    @foreach($projects->comments as $comment)
                            <strong>{{ $comment->user->name }}</strong>
                            <p>{{ $comments->description }}</p>
                        </div>
                    
                    <hr />
                    
                </div>
                
            </div>
             @endforeach
             @else 
    <p><em>There are no tasks assigned yet</em></p>
@endif

          
        </div>
    </div>
</div>











<!--end-->
   <br/>
<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus" aria-hidden="true"><i class="material-icons">comment</i></span>&nbsp;Add Comments</button>
</div> 


<div class="grid-example col s12 m6"><span class="flow-text">
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">
<div class="modal-content">

      <form method="post" action="{{ route('comments.store') }}">
    {{ csrf_field() }}

   <input type="hidden" name="commentable_type" value="App\Projects">
   <input type="hidden" name="commentable_id" value="{{$project->id}}">
    
   

    <h6><div class="text-dark">Proof of work done(Url/Photos)<span class="required text-light ">*</span></h6>
   <div class="card-panel">
    
    <div class="form-group">
        <input placeholder="Enter url or screenshots"  
            required
            name="url"
            spellcheck="false"
            class="form-control"
             />
           </div>

    </div>


    <div class="form-group">
        <h6 for="comment-content">Comment</h6>
        <textarea placeholder="Enter Comment" 
            style="resize: vertical" 
            id="company-content"
            name="body"
            rows="3" spellcheck="false"
            class="form-control autosize-target text-left">
          </textarea>
          <br/>
           </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary"
               value="Submit"/>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>

  </div>
</form>
 </div>    





      <div class="my-3 p-3 bg-white rounded box-shadow">
        
        <div class="media text-muted pt-3">
          {{--@foreach($project->projects as $project)
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="container">
            <div class="row">
            <div class="row justify-content-md-center">
            <div class="col-md-auto">
            <div class="border-top">
            <strong class="d-block text-gray-dark ">{{ $project->name }}</strong>
            <p>{{ $project->description }}</p>
            <a class="btn btn-primary float-right btn btn-secondary btn-md" href="/project/{{ $project->id }}" role="button">View Project »</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</p>
          </div>
        </div>
      @endforeach--}}
                </div>
              </div>
            </div>
        </div>
      </div>
  </main>
  </div>
</body>


    <div class="pull-left">
  <!--<div class="row col-md-3 col-lg-3 col-sm-3 pull-right">-->
    <div class="container">
      <div class="row">
        <div class="col">
            <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
              <li><a href="/project/create">Create new Client</a></li>
              <li><a href="/projects">My Clients</a></li>
              

              <br/>
              @if($project->user_id == Auth::user()->id) <!--check the logged in user-->
              <li>
                <a   
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this project?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}" 
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}</a>
                      </li>
              @endif
              <!--<li><a href="#">Add user</a></li>-->
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Users</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
            </ol>
          </div>
        </div>
      </div>
  </div>
        

@endsection