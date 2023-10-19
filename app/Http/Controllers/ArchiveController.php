<?php

namespace App\Http\Controllers;

use App\Services\ArchiveService;
use App\Services\BookingService;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function viewById(Request $request)
    {
        $archive = new ArchiveService();
        $data = $archive->findById($request->id);

        return view('archive.one_view', ['data' => $data]);
    }

    public function viewAll()
    {
        $archive = new ArchiveService();
        $data = $archive->findAll();
        return view('archive.all', ['data' => $data]);
    }


    public function entryArchive(Request $request)
    {
        $id = $request->id;
        $bookingService = new BookingService();
        $data = $bookingService->findById($id);// Получаем данные бронирования по id из БД booking
        $archiveService = new ArchiveService();
        $archiveService->save($data, $request->otz);// Добавляем новый архив
        $bookingService->delete($id); // Удалили запись из БД

        return redirect()->action('OrderController@view');
    }

    public function delete(Request $request)
    {
        $archiveService = new ArchiveService();
        $archiveService->delete($request->id);
        return redirect()->action("ArchiveController@viewAll");
    }

    public function back(Request $request)
    {
        $archiveService = new ArchiveService();
        $archiveService->back($request->id);
        return redirect()->route("orders");

    }


}
