<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DankeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\QiwiController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function(){

    Route::match(["get", "post"], '/to_queue', [QueueController::class, 'toQueue'])->name('to.queue')->middleware('admin');


});

Route::get('/', [FrontController::class, 'front'])->name("front");

Route::post('/add_calendar', [CalendarController::class, 'addInfo'])->name("add.calendar");
Route::post('/order_info', [CalendarController::class, 'verification'])->name("order.info");
Route::get('/test', [CalendarController::class, 'view']);
Route::get('/error_book', [CalendarController::class, 'comeErrorBlade'])->name('error.book');
Route::post('/add_booking', [CalendarController::class, 'addBooking'])->name("add.booking");


Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/reports', [ReportsController::class, 'view'])->name('reports')->middleware('admin');


Route::match(["get", "post"], '/front_edit', [SettingsController::class, 'front'])->name("front.edit")->middleware('admin');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware('admin');

Route::post('/q_result', [QiwiController::class, 'result']);
Route::post('/q_pay', [QiwiController::class, 'pay']);
Route::get('/q_success', [QiwiController::class, 'success']);
Route::get('/q_pay/{id}/pay', [QiwiController::class, 'verification']);


Route::match(["get", "post"], '/queue/{id}/update', [QueueController::class, 'update'])->name('update.queue')->middleware('admin');
Route::get('/view_queue', [QueueController::class, 'view'])->name('view.queue')->middleware('admin');
Route::get('/queue/{id}/delete', [QueueController::class, 'delete'])->name('delete.queue')->middleware('admin');


Route::get('/profile', [ProfileController::class, 'view'])->name('profile');

Route::post('/in_archive', [ArchiveController::class, 'entryArchive'])->name('in.archive')->middleware('admin');
Route::get('/view/{id}/archive', [ArchiveController::class, 'viewById'])->name('view.archive')->middleware('admin');
Route::get('/archive', [ArchiveController::class, 'viewAll'])->name('archive')->middleware('admin');
Route::get('/archive/{id}/delete', [ArchiveController::class, 'delete'])->name('delete.archive')->middleware('admin');
Route::get('/archive/{id}/back', [ArchiveController::class, 'back'])->name('archive.back')->middleware('admin');

Route::get('/order/{id}/verification', [VerificationController::class, 'verificationUserBook'])->middleware('admin');

Route::match(['get', 'post'], '/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit')->middleware('admin');
Route::get('/orders', [OrderController::class, 'view'])->name("orders")->middleware('admin');
Route::get('/order/{id}/reject', [OrderController::class, 'reject'])->name('reject')->middleware('admin');
Route::get('/order/{id}/confirm', [OrderController::class, 'confirm'])->name('order.confirm')->middleware('admin');
Route::get('/order/{id}/delete', [OrderController::class, 'delete'])->middleware('admin');
Route::get('/ord/{id}/delete', [OrderController::class, 'deleteProf']);
Route::get('/order/{id}/to_pay', [OrderController::class, 'toPayView'])->name('order.to_pay')->middleware('admin');
Route::post('/to_pay', [OrderController::class, 'toPay'])->name('to.pay')->middleware('admin');

Route::get('/danke', [DankeController::class, 'view'])->name('danke');

Route::get('/del_schedule', [ScheduleController::class, 'delSchedule'])->name('del.schedule')->middleware('admin');
Route::post('/verification', [ScheduleController::class, 'verification']);
Route::get('/schedule', [ScheduleController::class, 'view'])->name("schedule")->middleware('admin');
Route::post('/edit_table', [ScheduleController::class, 'editScheduleCost'])->name('edit.table')->middleware('admin');
Route::match(['get', 'post'], '/schedule_edit', [ScheduleController::class, 'edit'])->name('schedule.edit')->middleware('admin');
Route::match(['get', 'post'], '/schedule_add', [ScheduleController::class, 'add'])->name('schedule.add')->middleware('admin');
Route::match(['get', 'post'], '/edit_schedule_mass', [ScheduleController::class, 'updateDiaDates'])->name('edit_schedule_mass')->middleware('admin');


Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return "Ок...";
});

Route::get('/run', function () {
    Artisan::call('schedule:run');
    return "Ок...";
});