<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('projects', 'ProjectsController');

Route::resource('companies', 'CompaniesController');

Route::resource('tasks', 'TaskController');

//Route::post('/projects/adduser', 'ProjectsController@adduser')->name('project.adduser');
Route::get('projects/create/{company_id?}', 'ProjectsController@create');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/companies', 'CompaniesController@index')->name('companies.index');
Route::post('companies/store', 'CompaniesController@store')->name('companies.store');
Route::get('/companies/delete/{id}', 'CompaniesController@destroy')->name('companies.delete');
Route::get('/companies/create', 'CompaniesController@create')->name('companies.create') ;

// ===================== PROJECTS ======================
	Route::get('/projects', 'ProjectsController@index')->name('projects.index');
	//Route::get('/projects', 'ProjectsController@index')->name('projects.show') ;
	Route::get('/projects/create', 'ProjectsController@create')->name('projects.create') ;
	Route::get('/projects/edit/{id}', 'ProjectsController@edit')->name('projects.edit') ;
	Route::get('/projects/view/{id}', 'ProjectsController@view')->name('projects.view') ;
	Route::put('/projects/update/{id}', 'ProjectsController@update')->name('projects.update') ;
	Route::get('/projects/delete/{id}', 'ProjectsController@destroy')->name('projects.delete') ;
	// Store the new project from the form posted with the view Above
	Route::post('/projects/store', 'ProjectsController@store')->name('projects.store');
	Route::get('/projects/list/{id}','ProjectsController@projectsTaskList')->name('projects.list');



// ====================  TASKS =======================
Route::get('/tasks','TaskController@index')->name('task.index') ;
	Route::get('/tasks/view/{id}','TaskController@view')->name('task.view') ;
	// Display the Create Task View form
	Route::get('/tasks/create', 'TaskController@create')->name('task.create'); 
	// Store the new task from the form posted with the view Above
	Route::post('/tasks/store', 'TaskController@store')->name('task.store');
	// Search view
	// Route::get('/tasks/search', 'TaskController@searchTask')->name('task.search');
    // USER TASK SEARCH
    Route::get('tasks/search', 'TaskController@searchTask')->name('task.search') ;
	// Sort Table
	Route::get('/tasks/sort/{key}', 'TaskController@sort')->name('task.sort') ;
	Route::get('/tasks/edit/{id}','TaskController@edit')->name('task.edit');
	Route::get('/tasks/list/{projectid}','TaskController@tasklist')->name('task.list');
	Route::get('/tasks/delete/{id}', 'TaskController@destroy')->name('task.delete') ;
	Route::get('/tasks/deletefile/{id}', 'TaskController@deleteFile')->name('task.deletefile') ;
	Route::post('/tasks/update/{id}', 'TaskController@update')->name('task.update') ;
	Route::get('/tasks/completed/{id}','TaskController@completed')->name('task.completed');

		// =====================  USERS   ============================
	Route::get('/users', 'UsersController@index')->name('user.index'); 
	Route::get('/users/list/{id}','UsersController@userTaskList')->name('user.list');
	Route::get('/users/create', 'UsersController@create')->name('user.create'); 
    Route::post('/users/store', 'UsersController@store')->name('user.store'); 
	Route::get('/users/edit/{id}', 'UsersController@edit')->name('user.edit'); 
	Route::post('/users/update/{id}', 'UsersController@update')->name('user.update') ;
    Route::get('/users/activate/{id}', 'UsersController@activate')->name('user.activate') ; 
    Route::get('/users/delete/{id}', 'UsersController@destroy')->name('user.delete') ;
    Route::get('/users/disable/{id}', 'UsersController@disable')->name('user.disable') ;
    /*
    -------------------------------------------COMMENTS------------------------------------
    */
      Route::resource('comments', 'CommentsController');
