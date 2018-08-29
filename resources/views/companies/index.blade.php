@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">

<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add Client</button>
</div>
<!---Modal-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

      <!-- Example row of columns -->
      <div class="modal-content">
      	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter Client Info</h4>
      </div>

    <form method="post" action="{{ route('companies.store') }}">
                            {{ csrf_field() }}


                            <div class="form-group ">
                            	<h6 class="modal-title">Name<span class="required">*</span></h6>
                                <input   placeholder="Enter name"  
                                          id="company-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                           />
                            </div>


                            <div class="form-group font-weight-bold">
                            	<h6 class="modal-title">Description</h6>
                                <textarea placeholder="Enter description" 
                                          style="resize: vertical" 
                                          id="company-content"
                                          name="description"
                                          rows="5" spellcheck="false"
                                          class="form-control autosize-target text-left">

                                          </textarea>
                            </div>
                            <div class="btn-group">
							    <input class="btn btn-primary" type="submit" value="Submit" onclick="return validateForm()">
							    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							    <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
							</div>
                            
                        </form>
                    </div>
                </div>

   

      </div>
</div>





<!--End of Moadal -->

			<div class="table-responsive">
			<table class="table table-striped">
			<thead>
			  <tr>
			    <th>Client Name</th>
			    <th>Edit</th>
			    <th>Delete</th>
			  </tr>
			</thead>

			@if ( !$companies->isEmpty() ) 
			<tbody>
			@foreach ( $companies  as $company)
			  <tr>
			    <td><i class="fa fa-play" aria-hidden="true"></i> <a href="/companies/{{ $company->id }}" >  {{ $company->name }}</a></li> </td>
			    <td>
			      <a class="btn btn-primary" href="{{ route('companies.edit', [ 'id' => $company->id ]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"><i class="material-icons">edit</i></span></a> 
			      
			      </td>
			      <td>         
			      <a class="btn btn-danger" href="{{ route('companies.delete', [ 'id' => $company->id ]) }}" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"><i class="material-icons">delete</i></span></a>&nbsp;&nbsp;
			    </td>


			  </tr>

			@endforeach
			</tbody>
			@else 
			<p><em>There are no tasks assigned yet</em></p>
			@endif


			</table>
			</div>

			@endsection