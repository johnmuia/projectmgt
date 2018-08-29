@extends('layouts.app')

@section('content')

@include('partials.errors')

<!--<div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white;">-->
<h1>Update project </h1>

      <!-- Example row of columns -->
     <div class="col-md-6 col-lg-6 col-sm-6" >

      <form method="POST" action="{{ route('projects.update',['id'=>$edit_project['id']]) }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="put">
                            <div class="card">
                            <div class="form-group">
                              <div class="font-weight-bold">
                                <label for="project-name">Name<span class="required">*</span></label>
                                </div>
                                <input   placeholder="Enter name"  
                                          id="project-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control col-md-9 col-lg-9 col-sm-9"
                                          value="{{ $edit_project->name }}"
                                           />
                            </div>


                            <div class="form-group font-weight-bold">
                                <label for="project-content">Description</label>
                                <textarea placeholder="Enter description" 
                                          style="resize: vertical" 
                                          id="project-content"
                                          name="description"
                                          rows="5" spellcheck="false"
                                          class="form-control autosize-target text-left col-md-9 col-lg-9 col-sm-9">
                                          {{ $edit_project->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>
   

      </div>
</div>

<!--
<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> 
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/projects/{{ $edit_project->id }}"><i class="fa fa-building-o" aria-hidden="true"></i> View projects</a></li>
              <li><a href="/projects"><i class="fa fa-building" aria-hidden="true"></i> All projects</a></li>
              
            </ol>
          </div>

          <div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
            </ol>
          </div> 
        </div>-->


    @endsection