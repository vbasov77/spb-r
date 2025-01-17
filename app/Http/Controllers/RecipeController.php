<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recipes\CreateRecipeRequest;
use App\Services\CommentService;
use App\Services\FileService;
use App\Services\RecipeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\Factory;
use Illuminate\View\View;

class RecipeController extends Controller
{
    private $recipeService;
    private $fileService;
    private $commentService;

    /**
     * RecipeController constructor.
     */
    public function __construct()
    {
        $this->recipeService = new RecipeService();
        $this->fileService = new FileService();
        $this->commentService = new CommentService();
    }


    /**
     * @return View
     */
    public function index(): View
    {
        $recipes = $this->recipeService->findAll();

        return view('recipes.index', ['recipes' => $recipes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('recipes.create');
    }


    /**
     * @param CreateRecipeRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRecipeRequest $request): RedirectResponse
    {
        $text = $request->input('text') ?: [];
        $inputImg = $request->input('img') ?: [];
        $img = $request->file('img') ?: [];
        $newArray = $this->recipeService->getElementsArray($text, $img, $inputImg);

        $id = $this->recipeService->store($request, $newArray);

        return redirect()->action([RecipeController::class, 'show'], ['id' => $id]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $recipe = $this->recipeService->show($request->id);
        $elements = json_decode($recipe->elements);
        $ingredients = json_decode($recipe->ingredients);
        $comments = $this->commentService->findAllById($request->id);

        return view('recipes.show',
            ['recipe' => $recipe, 'elements' => $elements, 'comments' => $comments,
                'ingredients' => $ingredients]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        $recipe = $this->recipeService->show($request->id);
        $elements = json_decode($recipe->elements);
        $ingredients = (array)json_decode($recipe->ingredients);
        !empty(count($elements)) ? $count = count($elements) : $count = 0;
        !empty(count($ingredients)) ? $countIngredients = count($ingredients) : $countIngredients = 0;

        return view('recipes.edit', ['recipe' => $recipe, 'elements' => $elements,
            'count' => $count, 'ingredients' => $ingredients, 'countIngredients' => $countIngredients]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {

        $text = $request->input('text') ?: [];
        $inputImg = $request->input('img') ?: [];
        $img = $request->file('img') ?: [];
        $ingredients = array_filter($request->input('ingredients'));
        dd($ingredients);
        $elements = $this->recipeService->getElementsArray($text, $img, $inputImg);
        $this->recipeService->update($request, $elements, $ingredients);

        return redirect()->route('recipe', ['id' => $request->input('id')]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $this->recipeService->destroy($request->id);
            exit(json_encode(true));
        } catch (\Exception $e) {
            exit(json_encode($e));
        }
    }

    /**
     * @param Request $request
     */
    public function deleteImg(Request $request)
    {

        try {
            $this->recipeService->deleteImg($request);

            exit(true);
        } catch (\Exception $e) {
            exit(json_encode($e));
        }

    }

}
