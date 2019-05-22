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
    return view('index');
});

// Calenar view - Arwa 
Route::resource('/calendarView', 'facilityBookingController');
//Route::get('/facilitybookings', 'facilityBookingController@index');
//Route::get('/calendarView/{id}', 'facilityBookingController@getInfo');
Route::post('/ajaxss',function(){
    $facility_id=Input::get('facility_id');
    $calendar= 5;//=facilitybooking::where('facilityId','=',$facility_id)->get();
    //return view ('calendarView', compact('bookings','calendar'));
   // return ("hi arwa ");// view('personal');
   return \Response::jsan($calendar);

});

Route::post('/ajax', 'facilityBookingController@ajaxa')->name('test.ajax');

// FrontEnd - william
Route::get('/personal', function () { return view('personal');});
Route::get('/facilities', function () { return view('facilities');});
Route::get('/courses', function () { return view('courses');});
Route::get('/course-detail', function () { return view('course-detail');});
Route::get('/course-add', function () { return view('course-add');});
Route::get('/login', function () { return view('login');});
Route::get('/sigin', function () { return view('sigin');});
Route::get('/facility-add', function () { return view('facility-add');});
Route::get('/facility-detail', function () { return view('facility-detail');});
