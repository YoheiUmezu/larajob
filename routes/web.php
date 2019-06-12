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

Route::get('/', 'JobController@index');//job controllerのindexページを表示する為に変更

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/jobs/{id}/{job}','JobController@show')->name('jobs.show');//{job}はJobControllerのjobと同じ



//lecture 75以降
Route::get('/jobs/create', 'JobController@create')->name('job.create');//app.blade.phpでリンクをつくるために使用

Route::POST('/jobs/create','JobController@store')->name('job.store');

Route::get('/edit-jobs/{id}/edit', 'JobController@edit')->name('edit-jobs.edit');//ポスト済みの情報を変更する
Route::POST('/edit-jobs/{id}/edit', 'JobController@update')->name('edit-jobs.update');//情報を変更する


Route::get('/jobs/my-job','JobController@myjob')->name('my.job');

//Browse all
Route::get('/jobs/alljobs','JobController@allJobs')->name('alljobs');//全部のjobを表示する時に使う


//jobs application
Route::get('/jobs/applications','JobController@applicant')->name('applicant');//応募者

//company
//Route::get('/company/{id}/{name}','CompanyController@index')->name('company.index');
Route::get('/company/{id}/{company}','CompanyController@index')->name('company.index');//より多くの情報

//lecture71 company profile
Route::get('/company/create','CompanyController@create')->name('company.view');//company profile app.blade.phpでリンクを貼るときに使う

//lecture72 company information update
Route::POST('/company/create','CompanyController@store')->name('company.store');

//lecture73 update company cover image
Route::POST('/company/coverphoto','CompanyController@coverPhoto')->name('cover.photo');

//lecture 74 company logo update
Route::POST('/company/logo','CompanyController@companyLogo')->name('company.logo');





//user profile
Route::get('user/profile','UserController@index')->name('profile.view');
Route::POST('user/profile/create', 'UserController@store')->name('profile.create');//postは大文字でPOSTにすること
Route::POST('user/coverletter', 'UserController@coverletter')->name('cover.letter');//postは大文字でPOSTにすること
Route::POST('user/resume', 'UserController@resume')->name('resume');//postは大文字でPOSTにすること
Route::POST('user/avator', 'UserController@avatar')->name('avatar');//postは大文字でPOSTにすること

//employer view
Route::view('employer/register','auth.employer-register')->name('employer.register');//viewを使っているからcontrollerはいらない App.blade.php参照 home画面に新しいリストが出てくる
Route::POST('employer/register', 'EmployerRegisterController@employerRegister')->name('emp.register');//postは大文字でPOSTにすること


//applying for a job
Route::POST('/applications/{id}', 'JobController@apply')->name('apply');//postは大文字でPOSTにすること


//save and unsave job
Route::POST('/save/{id}', 'FavouriteController@savejob');
Route::POST('/unsave/{id}', 'FavouriteController@unSaveJob');

//search
Route::get('/jobs/search','JobController@searchJobs');




