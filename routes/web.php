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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('user/index');
});

Route::get('foo', function () {
    return view('employee/employee_list')->with('test','my name is ajay parmar');
    // return view('employee.employee_list');// same above
});
// Route::get('/employee{id}', function($id){
// 	return view('employee/employee_list');
// 	// echo $id;
// });
Route::get('blade', function () {
    return view('child');
});
Route::get('/user','UserController@login');

Route::get('/employee','EmployeeController@index');
Route::get('employee/getallEmployee','EmployeeController@getallEmployee');
Route::post('employee/addEmployee','EmployeeController@addEmployee');
Route::get('/employee/editEmployee','EmployeeController@editEmployee');
Route::post('/employee/updateEmployee','EmployeeController@updateEmployee');
Route::get('/employee/deleteEmployee','EmployeeController@deleteEmployee');

Route::get('/inlinecrud/inlinecrud1','InlineCrudController@InlineCrud1');
Route::get('/inlinecrud/getallemplist','InlineCrudController@getallEmpList');
Route::get('/inlinecrud/inlinecrud2','InlineCrudController@InlineCrud2');
Route::post('/inlinecrud/updateEmployee','InlineCrudController@updateEmployee');
Route::get('/inlinecrud/deleteEmployee','InlineCrudController@deleteEmployee');

Route::post('/user/login','UserController@login');