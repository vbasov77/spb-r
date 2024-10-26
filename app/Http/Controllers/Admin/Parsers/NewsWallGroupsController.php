<?php


namespace App\Http\Controllers\Admin\Parsers;


use App\Http\Controllers\Controller;
use App\Repositories\KeyRepository;
use App\Services\ParsersService\NewsWallGroupsService;
use App\Services\VkService;
use Illuminate\Http\Request;
use Illuminate\View\View;


class NewsWallGroupsController extends Controller
{
    /**
     * @var KeyRepository
     */
    private $keyRepository;

    /**
     * @var VkService
     */
    private $vkService;

    private $newsWallGroupsService;

    /**
     * NewsWallGroupsController constructor.
     */
    public function __construct()
    {
        $this->keyRepository = new KeyRepository();
        $this->vkService = new VkService();
        $this->newsWallGroupsService = new NewsWallGroupsService();

    }


    /**
     * @return View
     */
    public function showGetNewsWallGroups(): View
    {
        $date = date("Y-m-d");

        return view('parsers.wallGroups', ['date' => $date]);
    }

    public function storeNewsWallGroups(Request $request)
    {
        $srcFileNameCsv = $this->newsWallGroupsService->storeNewsWallGroups($request);

        return redirect()->route("admin.read.file", ['file' => $srcFileNameCsv]);
    }

}