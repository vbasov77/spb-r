<?php


declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArchiveService;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    /**
     * @param ArchiveService $archiveService
     * @param Request $request
     * @return View
     */
    public function index(ArchiveService $archiveService, Request $request): View
    {
        $data = $archiveService->findById($request->id);
        return view('archive.index', ['data' => $data]);
    }


    /**
     *
     * @param ArchiveService $archiveService
     * @return View
     */
    public function viewAll(ArchiveService $archiveService): View
    {
        $data = $archiveService->findAll();
        return view('archive.all', ['data' => $data]);
    }

    /**
     * @param ArchiveService $archiveService
     * @param BookingService $bookingService
     * @param Request $request
     * @return RedirectResponse
     */
    public function entryArchive(ArchiveService $archiveService,
                                 BookingService $bookingService,
                                 Request $request): RedirectResponse
    {
        $id = (int)$request->id;
        $data = $bookingService->findById($id);// Получаем данные бронирования по id из БД booking
        $archiveService->save($data, $request->otz);// Добавляем новый архив
        $bookingService->delete($id); // Удалили запись из БД

        return redirect()->action([OrderController::class, 'index']);
    }

    /**
     * @param ArchiveService $archiveService
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(ArchiveService $archiveService, Request $request): RedirectResponse
    {
        $archiveService->delete((int)$request->id);
        return redirect()->action([ArchiveController::class, 'viewAll']);
    }

    /**
     * @param ArchiveService $archiveService
     * @param Request $request
     * @return RedirectResponse
     */
    public function back(ArchiveService $archiveService, Request $request): RedirectResponse
    {
        $archiveService->back((int)$request->id);
        return redirect()->route("admin.orders");
    }


}
