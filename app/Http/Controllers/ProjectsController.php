<?php

namespace App\Http\Controllers;
use Session;
use App\Comment;
use App\Project;
use App\Task;
use App\Company;
use App\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         //
         if( Auth::check() ){
             //$projects = Project::where('user_id', Auth::user()->id)->get();
            $companies =  Company::all() ; 
            $projects = Project::all();
            return view('projects.index',['projects'=> $projects], ['companies'=>$companies]);
            //->with('companies', $companies);
              //return view('projects.index', ['projects'=> $projects]);  
         }
         return view('auth.login');

     }

     public function adduser(Request $request){
         //add user to projects 

         //take a project, add a user to it
         $project = Project::find($request->input('project_id'));

        

         if(Auth::user()->id == $project->user_id){

         $user = User::where('email', $request->input('email'))->first(); //single record

         //check if user is already added to the project
         $projectUser = ProjectUser::where('user_id',$user->id)
                                    ->where('project_id',$project->id)
                                    ->first();
                                    
            if($projectUser){
                //if user already exists, exit 
        
                return response()->json(['success' ,  $request->input('email').' is already a member of this project']); 
               
            }


            if($user && $project){

                $project->users()->attach($user->id); 

                     return response()->json(['success' ,  $request->input('email').' was added to the project successfully']); 
                        
                    }
                    
         }

         return redirect()->route('projects.index', ['project'=> $project->id])
         ->with('errors' ,  'Error adding user to project');
        

         
     }



     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     
    public function create()
    {
        $projects = Project::all()  ;
        $companies = Company::all() ;
        return view('projects.create')->with('companies', $companies);
                                  
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         //
 
         if(Auth::check()){
             $projects = Project::create([
                 'name' => $request->input('name'),
                 'description' => $request->input('description'),
                 'company_id' => $request->input('company_id'),
                 'user_id' => Auth::user()->id
             ]);
 
 
             if($projects){
                 return redirect()->route('projects.index', ['projects'=> $projects->id])
                 ->with('companies' , '$companies');
                // return view('task.create')->with('projects', $projects) 
                                  //->with('companies', $companies) ;
                                  //->with('success', 'project created success');
             }
 
         }
         
             return back()->withInput()->with('errors', 'Error creating new project');
 
     }

    
 
     /**
      * Display the specified resource.
      *
      * @param  \App\project  $project
      * @return \Illuminate\Http\Response
      */
     public function show(Project $project)
     {
         //
        $users=User::all();
        $companies=Company::all();
        $project = Project::find($project->id);
 
        $comment = $project->comments;
         //return view('projects.show', ['project'=>$project, 'comments'=> $comments ]);

        //$comment = $project->comment;
      return view('projects.show', ['project'=>$project, 'comment'=> $comment, 'companies'=>$companies, 'users'=>$users ]);
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\project  $project
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         //
         $edit_project = Project::find($id);
         
         return view('projects.edit')->with('edit_project', $edit_project) ;
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\project  $project
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
       //save data
      $update_project = Project::find($id);
      $update_project->name=$request->name;
      $update_project->save();
      Session::flash('success', 'Project was successfully edited');
      return redirect()->route('projects.index');   
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\project  $project
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         //
      $delete_project = Project::find($id);
      $delete_project->delete();
      Session::flash('success', 'Task was deleted');
      return redirect()->back();
    }
    public function projectsTaskList($id) {

        $project_name = Project::find($id) ;
        $task_list = Task::where('id','=' , $id)->get();
        // return view('user.list')->with('username', $username)
        //             ->with('task_list', $task_list) ;
        return view('projects.list', compact('task_list', 'project_name') ) ;
    }
}