<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['as'=>'home','uses'=>'HomeController@index']);

Route::resource('admin/school-classes', 'SchoolClassesController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::post('auth/logout', 'Auth\AuthController@getLogout');

//Ledger routes
Route::get('admin/ledger/setClass','LedgerController@index');
Route::post('admin/ledger/generate-ledger','LedgerController@generateLedger');


//Marksheet routes
Route::get('admin/marksheet/setClass','MarksheetController@index');
Route::post('admin/marksheet/generate-marksheet','MarksheetController@generateMarksheet');

//Attendence routes
Route::get('admin/attendence/setClass','AttendenceController@index');

//custom routes marks-entry
Route::get('admin/marks-entry/newCreate', 'MarksEntryController@newCreate');
Route::get('admin/marks-entry/editMarks', 'MarksEntryController@editMarks');
Route::get('admin/marks-entry/showMarks', 'MarksEntryController@showMarks');
Route::post('admin/marks-entry/updateMarks', 'MarksEntryController@updateMarks');

//custom routes attendence
Route::get('admin/attendence/newCreate', 'AttendenceController@newCreate');
Route::get('admin/attendence/editAttendence', 'AttendenceController@editAttendence');
Route::get('admin/attendence/showAttendence', 'AttendenceController@showAttendence');
Route::post('admin/attendence/updateAttendence', 'AttendenceController@updateAttendence');

//custom routes attendence
Route::get('admin/roll/newCreate', 'RollController@newCreate');

//custom routes subject
Route::get('admin/subjects/newCreate', 'SubjectsController@newCreate');
Route::get('admin/subjects/editSubject', 'SubjectsController@editSubject');
Route::get('admin/subjects/showSubject', 'SubjectsController@showSubject');
Route::post('admin/subjects/updateSubject', 'SubjectsController@updateSubject');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::resource('admin/sections', 'SectionsController');
Route::resource('admin/students', 'StudentsController');
Route::resource('admin/subjects', 'SubjectsController');
Route::resource('admin/examinations', 'ExaminationsController');
Route::resource('admin/marks-setting', 'MarksSettingController');
Route::resource('admin/marks-entry', 'MarksEntryController');
Route::resource('admin/attendence', 'AttendenceController');
Route::resource('admin/roll', 'RollController');

// Ajax routes
Route::get('ajaxSubjects','MarksSettingController@getSubjects');
Route::get('ajaxClassSubjects','MarksEntryController@getSubjects');

Route::resource('admin/subject-setting', 'SubjectSettingController');