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

Route::group(['middleware' => 'auth'], function() {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('projects/my_projects', 'ProjectController@index')->name('projects.my');
  Route::get('projects/downloadPDF/{id}', 'ProjectController@downloadPDF')->name('projects.downloadPDF');
  Route::get('projects/export_projects', 'ProjectController@exportProjects')->name('projects.exportProjects');
  Route::post('projects/import_projects', 'ProjectController@importProjects')->name('projects.importProjects');
  Route::post('projects/ajax_projects', 'ProjectController@ajaxProjects')->name('projects.ajaxProjects');
  Route::resource('user', 'UserController');
  Route::resource('projects', 'ProjectController');
  Route::resource('skills', 'SkillController')->except(['edit', 'update', 'show']);
});
