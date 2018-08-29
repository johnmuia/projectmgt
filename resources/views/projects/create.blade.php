@extends('layouts.app')

@section('content')
<form id="task_form" action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="col-md-8">
        <label>Create new project <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter Project Title" name="project_title">
        </div>

        
    <div class="form-group">
            <input type="file" class="form-control" name="photos[]" multiple>
        </div>

        <div class="form-group">
            <textarea class="form-control my-editor" rows="10" id="task" name="task"></textarea>
        </div>
        
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Assign to client <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span></label>
            <select name="project_id" class="selectpicker" data-style="btn-primary" style="width:100%;">
                @foreach( $companies as $company )
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                 @endforeach
            </select>
        </div>


        <div class="form-group">
            <label>Select Priority <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
            <select name="priority" class="selectpicker" data-style="btn-info" style="width:100%;">
              <option value="0">Normal</option>
              <option value="1">High</option>
            </select>
        </div>


        <div class="btn-group">
            <input class="btn btn-primary" type="submit" value="Submit" onclick="return validateForm()">
            <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
        </div>

    </div>

</form>