<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DankeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\QiwiController;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Admin\Parsers\NewsWallGroupsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TopPlacesController;
use App\Http\Controllers\Admin\ImgPlaceController;
use App\Http\Controllers\MissedDatesController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticleController;

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
Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {

    Route::get('/queues', [QueueController::class, 'toQueue'])
        ->name('in.queue')->middleware('admin');
    Route::post('/queues', [QueueController::class, 'addQueue'])
        ->name('in.queue')->middleware('admin');

    Route::get('/queue/{id}/edit', [QueueController::class, 'editView'])
        ->name('update.queue')->middleware('admin');
    Route::post('/queue/{id}/edit', [QueueController::class, 'edit'])
        ->name('update.queue')->middleware('admin');

    Route::get('/view_queue', [QueueController::class, 'queueList'])
        ->name('view.queue')->middleware('admin');
    Route::get('/queue/{id}/delete', [QueueController::class, 'delete'])->name('delete.queue')
        ->middleware('admin')->where("id", "\d+");

    Route::get('/order/{id}/verification', [VerificationController::class, 'verificationUserBook'])
        ->name("order.verification")->middleware('admin')->where("id", "\d+");

    Route::get('/order/{id}/edit', [OrderController::class, 'viewEdit'])->name('order.edit.view')
        ->where("id", "\d+")->middleware('admin');
    Route::post('/order/edit', [OrderController::class, 'edit'])->name('order.edit')
        ->middleware('admin');

    Route::get('/edit/{id}/dates', [OrderController::class, 'editDates'])->name('edit.dates')
        ->where("id", "\d+")->middleware('admin');
    Route::post('/update_dates', [OrderController::class, 'updateDates'])->name('update.dates')
        ->middleware('admin');

    Route::get('/orders', [OrderController::class, 'ordersList'])->name("orders")
        ->middleware('admin');
    Route::get('/order/{id}/reject', [OrderController::class, 'reject'])->name('order.reject')
        ->middleware('admin')->where("id", "\d+");
    Route::get('/order/{id}/confirm', [OrderController::class, 'confirm'])->name('order.confirm')
        ->middleware('admin');

    Route::get('/delete/{id}/order', [OrderController::class, 'deleteProf'])->name("order.deleteProf")
        ->middleware("admin");

    Route::get('/order/{id}/to_pay', [OrderController::class, 'toPayView'])
        ->name('order.to_pay')->middleware('admin')->where("id", "\d+");
    Route::post('/to_pay', [OrderController::class, 'toPay'])->name('to.pay')
        ->middleware('admin');

    Route::post('/in_archive', [ArchiveController::class, 'entryArchive'])->name('in.archive')
        ->middleware('admin');
    Route::post('/update_archive', [ArchiveController::class, 'update'])->name('update.archive')
        ->middleware('admin');
    Route::get('/view/{id}/archive', [ArchiveController::class, 'index'])->name('view.archive')
        ->middleware('admin');
    Route::get('/edit/{id}/archive', [ArchiveController::class, 'edit'])->name('edit.archive')
        ->middleware('admin');
    Route::get('/archive', [ArchiveController::class, 'viewAll'])->name('archive')
        ->middleware('admin');
    Route::get('/archive/{id}/delete', [ArchiveController::class, 'delete'])->name('delete.archive')
        ->middleware('admin');


    Route::get('/reports', [ReportController::class, 'index'])->name('reports')
        ->middleware('admin');
    Route::get('/create-report', [ReportController::class, 'update'])->name('create.report')
        ->middleware('admin');
    Route::post('/edit-report', [ReportController::class, 'edit'])->name('edit.report')
        ->middleware('admin');

    Route::match(["get", "post"], '/front_edit', [SettingsController::class, 'front'])->name("front.edit")
        ->middleware('admin');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings')
        ->middleware('admin');

    Route::get('/del_schedule', [ScheduleController::class, 'delSchedule'])->name('del.schedule')
        ->middleware('admin');
    Route::get('/schedule', [ScheduleController::class, 'view'])->name("schedule")
        ->middleware('admin');
    Route::post('/edit_table', [ScheduleController::class, 'editScheduleCost'])->name('edit.table')
        ->middleware('admin');
    Route::match(['get', 'post'], '/schedule_edit', [ScheduleController::class, 'edit'])->name('schedule.edit')
        ->middleware('admin');
    Route::match(['get', 'post'], '/schedule_add', [ScheduleController::class, 'add'])->name('schedule.add')
        ->middleware('admin');
    Route::match(['get', 'post'], '/edit_schedule_mass', [ScheduleController::class, 'edit'])->name('edit.schedule.mass')->middleware('admin');
    Route::get('/view_add_order_is_admin', [BookingController::class, 'viewAddOrderIsAdmin'])->name('view_add_order_is_admin')->middleware('admin');
    Route::post('/add_order_is_admin', [BookingController::class, 'addOrderIsAdmin'])->name('add_order_is_admin')->middleware('admin');

    Route::get('/missed_dates', [MissedDatesController::class, 'create'])->name('missed.dates')->middleware('admin');
    Route::post('/store_missed_dates', [MissedDatesController::class, 'store'])->name('store_missed_dates')->middleware('admin');

    Route::post('/storeNewsWallGroups', [NewsWallGroupsController::class, 'storeNewsWallGroups'])->name('parser.store-wallGroupsNews')->middleware('admin');
    Route::get('/parser-wallGroupsNews', [NewsWallGroupsController::class, 'showGetNewsWallGroups'])->name('parser.view-wallGroupsNews')->middleware('admin');


    Route::get('/read-file', [FileController::class, 'readFile'])->name('read.file')->middleware('admin');
    Route::delete('/delete-file/name{id}', [FileController::class, 'destroyFile'])->name('destroy.file')->middleware('admin');
    Route::get('/index-files', [FileController::class, 'index'])->name('files')->middleware('admin');

    Route::post('/upload_img/place{id}', [ImgPlaceController::class, 'create'])->middleware('admin');
    Route::delete('/delete_img', [ImgPlaceController::class, 'destroy'])->middleware('admin');


    Route::get('/create-place', [TopPlacesController::class, 'create'])->name('create.place')->middleware('admin');
    Route::get('/edit-place/id{id}', [TopPlacesController::class, 'edit'])->name('edit.place')->middleware('admin');
    Route::post('/store-place', [TopPlacesController::class, 'store'])->name('store.place')->middleware('admin');
    Route::post('/edit_place/id{id}', [TopPlacesController::class, 'update'])->middleware('admin');
    Route::delete('/delete-place/id{id}', [TopPlacesController::class, 'destroy'])->middleware('admin');

    Route::get('/news-edit', [NewsController::class, 'edit'])->name('edit.news')->middleware('admin');
    Route::post('/news-create', [NewsController::class, 'update'])->name('update.news')->middleware('admin');

});

Route::get('/show-place/id{id}', [TopPlacesController::class, 'show'])->name('show.place');
Route::get('/list-places', [TopPlacesController::class, 'index'])->name('list.places');

Route::get('/create-news', [NewsController::class, 'create'])->name('create.news')->middleware('role: moderator, admin');
Route::post('/store-news', [NewsController::class, 'store'])->name('store.news')->middleware('role: moderator, admin');
Route::delete('/delete-post/id{id}', [NewsController::class, 'destroy'])->name('delete.post')->middleware('role: moderator, admin');
Route::get('/my-news', [NewsController::class, 'newsByUserId'])->name('my.news')->middleware('role: moderator, admin');
Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::get('/post{id}', [NewsController::class, 'show'])->name('post');

Route::get('/error-message', [ErrorController::class, 'view'])->name('error.message');


Route::get('/', [FrontController::class, 'front'])->name("front");
Route::get('/portfolio', [PortfolioController::class, 'show'])->name("portfolio");
Route::get('/articles', [ArticleController::class, 'viewAll'])->name("articles");
Route::get('/article/id{id}', [ArticleController::class, 'index'])
    ->name('article');
Route::get('/work{id}', 'MyWorksController@view')->name('work.id');

Route::post('/add_dates', [BookingController::class, 'addDates'])->name("add.dates");
Route::post('/order_info', [BookingController::class, 'orderInfo'])->name("add.order.info");
Route::get('/error_book', [BookingController::class, 'comeErrorBlade'])->name('error.book');
Route::post('/add_booking', [BookingController::class, 'addBooking'])->name("add.booking");

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/q_result', [QiwiController::class, 'result']);
Route::post('/q_pay', [QiwiController::class, 'pay']);
Route::get('/q_success', [QiwiController::class, 'success']);
Route::get('/q_pay/{id}/pay', [QiwiController::class, 'verification'])->where("id", "\d+");

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/order/{id}/delete', [OrderController::class, 'delete'])->name("order.delete")
    ->where("id", "\d+");

Route::get('/danke', [DankeController::class, 'view'])->name('danke');

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