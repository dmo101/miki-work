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
Route::get('admin/matchindex','AdminController@matchindex');
Route::get('admin/matchupdate/{id?}','AdminController@matchupdate');
Route::post('admin/matchupdate/{id?}','AdminController@matchupdate');
Route::get('admin/matchadd','AdminController@matchadd');
Route::post('admin/matchadd','AdminController@matchadd');
Route::get('admin/matchdelete/{id?}','AdminController@matchdelete');
Route::get('admin/matchview/{id?}','AdminController@matchview');
Route::get('admin/logout','AdminController@logout');
Route::get('admin/login','AdminController@login');
Route::get('admin/index','AdminController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/student_index', 'AdminController@studentIndex')->name('admin_student_index');
Route::get('admin/student_add', 'AdminController@studentAdd')->name('admin_student_add');

<<<<<<< HEAD
Route::get('admin/company_index', 'AdminController@companyindex')->name('admin_company_index');
Route::get('admin/company_add', 'AdminController@companyAdd')->name('admin_company_add');
Route::post('admin/company_add','AdminController@companyAdd')->name('admin_company_add');
Route::get('admin/company_edit', 'AdminController@companyEdit')->name('admin_company_edit');
Route::post('admin/company_edit','AdminController@companyEdit')->name('admin_company_edit');


=======
Route::post('admin/student_add','AdminController@studentAdd')->name('admin_student_add');

Route::get('admin/student_edit','AdminController@studentEdit')->name('admin_student_edit');
Route::post('admin/student_edit','AdminController@studentEdit')->name('admin_student_edit');



//company
>>>>>>> 22fc70b8fe42c35a3dc98df58678e4b93b4368f2
Route::get('company/login','CompanyController@login');
Route::post('company/login','CompanyController@login');
Route::get('company/register','CompanyController@register');
Route::post('company/register','CompanyController@register');
Route::get('company/edit','CompanyController@edit');
Route::post('company/edit','CompanyController@edit');
