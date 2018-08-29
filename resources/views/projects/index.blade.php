@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">


<h1>LIST OF ACTIVE PROJECTS</h1>

<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add New Project</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter Project Title</h4>
      </div>
      <div class="modal-body">
        <form id="project_form" action="{{ route('projects.store') }}" method="POST">
            {{ csrf_field() }}

          <h6 class="modal-title">Enter Project Name</h6>
          <div class="form-group">
                            <input type="text" class="form-control col-lg-12" placeholder="Enter Project Name" name="name" value="{{ old('name') }}"/>
                        </div>

                        @if($companies == null)
                                  <input   
                                  class="form-control"
                                  type="hidden"
                                          name="company_id"
                                          value="{{ $company_id }}"
                                           />
                                  </div>

                                  @endif

                            @if($companies != null)
                            <div class="form-group">
                                <h6 class="modal-title">Description</h6>

                                <select name="company_id" class="form-control" > 

                                @foreach($companies as $company)
                                        <option value="{{$company->id}}"> {{$company->name}} </option>
                                      @endforeach
                                </select>
                            </div>
                            @endif

                        <!--<h6 class="modal-title">Select Client</h6>-->


                      

                </div>

                <div class="form-group">
                  <h6 class="modal-title">Description</h6>
                    <textarea placeholder="Enter description" 
                              style="resize: vertical" 
                              id="project-content"
                              name="description"
                              rows="3" spellcheck="false"
                              class="form-control autosize-target text-left">

                              
                              </textarea>
                    </div>

        <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="Submit" >
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>





        </form>
      </div>

    </div>

  </div>
</div>
<!--  END modal  -->
<!---Show Comments-->






<!--end of comment section-->



<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th >Project Name</th>
        <th>Check Project</th>
        <th>Client's Name</th>
        <th>Project Tasks List</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

@if ( !$projects->isEmpty() ) 
    <tbody>
    @foreach ( $projects  as $project)
      <tr>
        <td>{{ $project->name }} </td>
        <td>
        <a class="btn btn-primary" href="{{ route('projects.show', [ 'id' => $project->id ]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true">View Project</span></a> 
    </td>
        <td>
          {{ $project->company->name }}</td>
         </td>
        <td>
           <a href="{{ route('task.list', [ 'projectid' => $project->id ]) }}">List all tasks</a>
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('projects.edit', [ 'id' => $project->id ]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"><i class="material-icons">edit</i></span></a>  
          </td>
          <td>        
          <a class="btn btn-danger" href="{{ route('projects.delete', [ 'id' => $project->id ]) }}" Onclick="return ConfirmDelete();"><i class="material-icons">delete</i><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;
        </td>

      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>There are no tasks assigned yet</em></p>
@endif


</table>
</div>




@stop


<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a Project will also delete all tasks associated with this project");
  if (x)
      return true;
  else
    return false;
}
</script> 