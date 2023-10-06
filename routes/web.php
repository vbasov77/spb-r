<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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

//Route::get('/', function () {
//    return view('front');
//});

Auth::routes();
Route::get('/danke', 'DankeController@view');
Route::get('/', 'FrontController@front')->name("front");
Route::post('/add_calendar', 'CalendarController@addInfo')->name("add.calendar");
Route::post('/order_info', 'CalendarController@verification')->name("order.info");
Route::get('/test', 'CalendarController@view');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/error_book', 'CalendarController@comeErrorBlade')->name('error.book');

Route::get('/reports', 'ReportsController@view')->name('reports')->middleware('admin');
Route::get('/del_schedule', 'ScheduleService@delSchedule')->name('del.schedule')->middleware('admin');

Route::get('/push&pav', 'TourismController@PushAndPav');
Route::post('/book_tourism', 'TourismController@PushAndPavBook');
Route::post('/add_tourism', 'TourismController@addPushAndPav');


Route::get('/front_settings', 'SettingsController@front')->middleware('admin');
Route::match(["get", "post"],'/front_edit', 'SettingsController@front')->middleware('admin');
Route::get('/settings', 'SettingsController@view')->middleware('admin');

Route::post('/q_result', 'QiwiController@result');
Route::post('/q_pay', 'QiwiController@pay');
Route::get('/q_success', 'QiwiController@success');
Route::get('/q_pay/{id}/pay', 'QiwiController@verification');


Route::get('/profile', 'ProfileController@view');
Route::post('/verification', 'ScheduleController@verification');
Route::post('/add_booking', 'CalendarController@addBooking')->name("add.booking");

Route::get('/orders', 'OrderController@view')->name("orders")->middleware('admin');
Route::post('/in_archive', 'ArchiveController@entryArchive')->middleware('admin');
Route::get('/view/{id}/arhiv', 'ArchiveController@viewById')->middleware('admin');
Route::post('/order_edit', 'OrderController@edit')->middleware('admin');
Route::get('/order/{id}/verification', 'VerificationController@verificationUserBook')->middleware('admin');
Route::get('/order/{id}/edit', 'OrderController@viewForEdit')->middleware('admin');
Route::get('/order/{id}/reject', 'OrderController@reject')->name('reject')->middleware('admin');
Route::get('/order/{id}/confirm', 'OrderController@confirm')->name('order.confirm')->middleware('admin');
Route::get('/order/{id}/delete', 'OrderController@delete')->middleware('admin');
Route::get('/schedule', 'ScheduleController@view')->name("schedule")->middleware('admin');
Route::get('/ord/{id}/delete', 'OrderController@deleteProf');
Route::get('/order/{id}/to_pay', 'OrderController@toPayView')->name('order.to_pay')->middleware('admin');
Route::post('/to_pay', 'OrderController@toPay')->middleware('admin');

Route::post('/edit_table', 'ScheduleController@editTable')->middleware('admin');
Route::post('/edit_schedule', 'ScheduleController@edit')->middleware('admin');
Route::post('/add_schedule', 'ScheduleController@schedule')->name("add.schedule")->middleware('admin');
Route::get('/schedule/add', 'ScheduleController@add')->middleware('admin');
Route::get('/schedule/edit', 'ScheduleController@viewEdit')->middleware('admin');
Route::match(['get', 'post'], '/edit_schedule_mass', 'ScheduleController@updateDiaDates')->name('edit_schedule_mass')->middleware('admin');

Route::get('/schedule/csv', 'ScheduleController@viewCsv')->middleware('admin');
Route::post('/get_csv', 'ScheduleController@getCsv')->middleware('admin');
Route::post('/update_csv', 'ScheduleController@updateCsv')->middleware('admin');

Route::get('/testy', 'TestController@test');

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
});

Route::get('/migrate', function() {
    Artisan::call('migrate');
    return "Ок...";
});

Route::get('/run', function() {
    Artisan::call('schedule:run');
    return "Ок...";
});