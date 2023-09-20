<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlansController;



Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();
Route::resource('post', PostController::class);


Route::get('create-chart', 'PlansControlle@projectDashboard');

Route::get('/plans/{id}/show', 'PlansController@show')->name('post.show');
Route::get('/plan/create', 'PlansController@create')->name('post.create');
Route::POST('/post', 'PlansController@store')->name('post.store');
Route::get('/plan/{id}/edit', 'PlansController@edit')->name('post.edit');
// Route::PUT('/plan/{id}', 'PlansController@update')->name('post.update');
Route::DELETE('/plan/{id}/destroy', 'PlansController@destroy')->name('postdestroy');
Route::get('/plans/{id}/evaluate' , 'PerforEvaluationController@show')->name('planevaluates');
Route::get('/plans/{id}/create' , 'PerforEvaluationController@create')->name('evaluatecreate');
Route::post('/plans/{id}/store' , 'PerforEvaluationController@store')->name('evaluatestore');
Route::get('/plans/{id}/index' , 'PerforEvaluationController@indexx')->name('evaluateshow');

// Route::get('project/{id?}/update' , 'ProjectController@update');
// Route::post('plan/{id}/edit' , 'PlansController@update');

Route::get('plan/{id?}/update' , 'PlansController@update');
Route::post('plan/{id?}/update' , 'PlansController@save');
Route::post('plan/{id}/running' , 'PlansController@Running')->name('plan_running');



Route::get('/evaluate{id}' , 'PerforEvaluationController@destroy')->name('actdestroy');




//activity

Route::get('plan/{id?}/activity/create' , 'ActivityController@create');
Route::post('plan/{id?}/activity/create' , 'ActivityController@store');


Route::get('plan/{id?}/addprog' , 'ProgressController@create')->name('prog_update');
Route::post('plan/{id?}/addprog' , 'ProgressController@store')->name('progstore');


Route::get('plan/{id?}/activity/addprog' , 'ProgressController@addactprog')->name('progact_add');
Route::post('plan/{id?}/activity/addprog' , 'ProgressController@actstore')->name('progactstore');


Route::get('plan/{id?}/activity/update' , 'ActivityController@update');
Route::post('plan/{id?}/activity/update' , 'ActivityController@save');

Route::post('plan/{id}/activity/running' , 'ActivityController@running')->name('activity_running');

//add Leader
Route::post('/plan/{id}/running' , 'PlansController@Running')->name('Running');
Route::post('/subtask/{id}/running' , 'subtaskController@running')->name('subtask_running');


Route::get('plan/activitys/{id}/Addsupervisor' ,'ActivityController@addsupervisor')->name('addsupervisor');
Route::put('plan/activitys/{id}/Addsupervisor' ,'ActivityController@savesupervisor')->name('savesupervisor');

//subact
Route::get('activitys/index' , 'ActivityController@index')->name('tasks.index');

Route::get('activitys/leader' , 'ActivityController@admin')->name('actadmin');


Route::get('/activitys/{id}/', 'ActivityController@show')->name('task.show');

//activity evaluate
Route::get('activitys/{id}/evaluate' , 'PerforEvaluationController@activshow')->name('actevaluates');

Route::get('activitys/{id}/create' , 'PerforEvaluationController@activcreate')->name('activevaluatecreate');
Route::post('activitys/{id}/store' , 'PerforEvaluationController@activstore')->name('activevaluatestore');
Route::get('activitys/{id}/index' , 'PerforEvaluationController@activindexx')->name('activevaluateshow');

//subactivity
Route::get('delete/{id}','PerforEvaluationController@destroy')->name('deletee');

Route::get('subactivity/{id}/evaluate' , 'PerforEvaluationController@subvshow')->name('subvevaluates');
Route::get('subactivity/{id}/create' , 'PerforEvaluationController@subvcreate')->name('subvevaluatecreate');
Route::post('subactivity/{id}/store' , 'PerforEvaluationController@subvstore')->name('subvevaluatestore');
Route::get('subactivity/{id}/index' , 'PerforEvaluationController@subvindexx')->name('subvevaluateshow');


Route::get('/activitys/subactivity/{id}/', 'SubactivitiesController@create');
Route::post('activitys/subactivity/{id}/store' , 'SubactivitiesController@store')->name('subtask.store');


// Route::post('activitys/subactivity/{id}/store', function(Request $request) {
//     $data = $request->all();
//         return Subactivity::create([
//             'title' => $data['title'],
//             'body' => $data['body'],

//             'name',
//             'start_date',
//             'end_date',
//             'description',
//             'Status',
//             'activ_id',
//             'empl_id'

//         ]);
// });
Route::get('activitys/{id?}/subactivity/update' , 'SubactivitiesController@update');

Route::post('activitys/{id?}/subactivity/update' , 'SubactivitiesController@save');

//subactivity
Route::get('/edit-progress/{id}','ProgressController@edit');
Route::post('/update-progress/{id}','ProgressController@updatee');

//act
Route::get('/editact-progress/{id}','ProgressController@editact');
Route::post('/updateact-progress/{id}','ProgressController@updatee');

//plan

Route::get('/editplan-progress/{id}','ProgressController@editplan');
Route::post('/updateplan-progress/{id}','ProgressController@updateplan');


Route::get('/editactevaluation/{id}','PerforEvaluationController@edit');
Route::post('/update-acteval/{id}','PerforEvaluationController@updateact');


Route::get('subactivity/index' , 'SubactivitiesController@index')->name('subtask.index');
Route::get('/subactivity/{id}/', 'SubactivitiesController@show')->name('subtask.show');

Route::get('subactivity/{id?}/show' , 'SubactivitiesController@show')->name('subactivity_show');
Route::post('subactivity/{id?}/show' , 'SubactivitiesController@finish');

Route::post('/task/{id}/running' , 'ActivityController@Running')->name('Running');
Route::post('/subactivity/{id}/running' , 'SubactivitiesController@running')->name('subactivity_running');


Route::get('activity/{id?}/subactivity/addprog' , 'ProgressController@addsubprog')->name('progsub_add');
Route::post('activity/{id?}/subactivity/addprog' , 'ProgressController@substore')->name('progsubstore');







Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/games', 'GamesController@index');
// Route::get('/teams', 'DepartmentsController@index');
// Route::get('/players/{dept_id}', 'DepartmentsController@players');
// Route::get('/table', 'TableController@index');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('homee');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('Departments', 'Admin\DepartmentsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\DepartmentsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::resource('Employees', 'Admin\EmployeesController');
    Route::post('players_mass_destroy', ['uses' => 'Admin\EmployeesController@massDestroy', 'as' => 'players.mass_destroy']);
    Route::resource('games', 'Admin\GamesController');
    Route::post('games_mass_destroy', ['uses' => 'Admin\GamesController@massDestroy', 'as' => 'games.mass_destroy']);

    // Route::resource('plans', 'PlansController');
    // Route::post('plans_mass_destroy', ['uses' => 'PlansController@massDestroy', 'as' => 'plans.mass_destroy']);




});

// Plan

// subtask
Route::get('plan/create/{id?}' , 'PlansController@create')->name('plan.create');
Route::post('plan/store/{id?}' , 'PlansController@store')->name('plan.store');

Route::get('plan/show/{id?}' , 'PlansController@show')->name('plan_show');
Route::post('plan/{id?}/show' , 'PlansController@finish');

Route::get('plan/index' , 'PlansController@index')->name('plan.index');

Route::get('plan/indexx' , 'PlansController@indexx')->name('plan.indexx');
Route::get('plan/admin' , 'PlansController@admin')->name('planadmin');

Route::get('plan/edit/{id?}' , 'PlansController@edit')->name('plan_edit');

Route::get('delete/{id}','PlansController@destroy')->name('deleteplan');

Route::get('deletea/{id}','ActivityController@destroy')->name('deleteact');
Route::get('deletes/{id}','SubactivitiesController@destroy')->name('deletesub');

// Route::get('plan/edit/{id}', ['as' => 'user.attendance', 'uses' => 'UserController@attendance']);
Route::get('plan/edit' , 'PlansController@massDestroy')->name('plans.destroy');
// Route::patch('/update/{id}', ['as' => 'plan.update', 'uses' => 'PlansController@update']);
 
// Route::delete('/delete/{id}', ['as' => 'member.delete', 'uses' => 'MemberController@delete']);

Route::get('plan/{id}/usersplan' , 'PlansController@userplan')->name('plan_user');
Route::post('plan/{id}/saveUsersTask' , 'PlansController@saveUserTask')->name('plan_saveuserplan');

// Route::post('/task/{id}/running' , 'TaskController@Running')->name('Running');
Route::post('/plan/{id}/running' , 'PlansController@running')->name('plan_running');
















