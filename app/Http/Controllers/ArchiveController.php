<?php

namespace App\Http\Controllers;

use App\Services\ArchiveService;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    public
    function index(ArchiveService $archiveService, Request $request): View
    {
        $data = $archiveService->findById($request->id);
        return view('archive.one_view', ['data' => $data]);
    }

    public
    function viewAll(ArchiveService $archiveService): View
    {
        $data = $archiveService->findAll();
        return view('archive.all', ['data' => $data]);
    }

    public
    function entryArchive(ArchiveService $archiveService,
                          BookingService $bookingService,
                          Request $request)
    {
        $id = $request->id;
        $data = $bookingService->findById($id);// Получаем данные бронирования по id из БД booking
        $archiveService->save($data, $request->otz);// Добавляем новый архив
        $bookingService->delete($id); // Удалили запись из БД

        return redirect()->action([OrderController::class, 'view']);
    }

    public
    function delete(ArchiveService $archiveService, Request $request)
    {
        $archiveService->delete($request->id);
        return redirect()->action([ArchiveController::class, 'viewAll']);
    }

    public
    function back(ArchiveService $archiveService, Request $request)
    {
        $archiveService->back($request->id);
        return redirect()->route("orders");
    }


}
