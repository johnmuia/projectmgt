<?php
namespace App\Http\Controllers;
use App\Project;
use App\Company;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class CompaniesController extends Controller
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
            $companies = Company::all();
            return view('companies.index')->with('companies', $companies);
            
        }
        return view('auth.login');
        //return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $companies = Company::all() ;
        return view('companies.create')->with('companies', $companies);
                                  
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
             $companies = Company::create([
                 'name' => $request->input('name'),
                 'description' => $request->input('description'),
                 'user_id' => Auth::user()->id
             ]);
 
 
             if($companies){
                 return redirect()->route('companies.index', ['companies'=> $companies->id])
                 ->with('companies' , '$companies')
                 ->with('success', 'Company created successfully');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
