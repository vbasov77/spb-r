<?php


namespace App\Services;


use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeService extends Service
{
    private $recipeRepository;
    private $fileService;

    /**
     * RecipeService constructor.
     */
    public function __construct()
    {
        $this->recipeRepository = new RecipeRepository();
        $this->fileService = new FileService();
    }

    /**
     * @param Request $request
     * @param array $elem
     * @return int
     */
    public function store(Request $request, array $elem): int
    {
        $jsonRecipe = collect($elem)->toJson();
        $recipe = [
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'elements' => $jsonRecipe
        ];

        return $this->recipeRepository->store($recipe);
    }

    /**
     * @param Request $request
     * @param array $elem
     * @param array $ingredients
     */
    public function update(Request $request, array $elem, array $ingredients): void
    {
        $jsonRecipe = collect($elem)->toJson();
        $jsonIngredients = collect($ingredients)->toJson();

        $recipe = [
            'id' => $request->input('id'),
            'user_id' => Auth::id(),
            'title' => $request->input('name'),
            'ingredients' => $jsonIngredients,
            'description' => $request->input('description'),
            'elements' => $jsonRecipe
        ];

        $this->recipeRepository->update($recipe);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return $this->recipeRepository->show($id);
    }

    /**
     * @return Recipe[]|Collection
     */
    public function findAll()
    {
        return $this->recipeRepository->findAll();
    }

    /**
     * Метод сливает два массива text и img в один - elements
     * для дальнейшего перевода в Json
     *
     * @param array $text
     * @param array $img
     * @param array $inputImg
     * @return array
     */
    public function getElementsArray(array $text, array $img, array $inputImg): array
    {
        $newArray = [];
        $count = $this->getMaxKey($text, $img, $inputImg);

        for ($i = 0; $i <= $count; $i++) {
            if (!empty($text[$i])) {
                $newArray[] = ['elem' => 'text', 'v' => $text[$i], 'code' => $this->getRandomString()];
            } elseif (!empty($inputImg[$i])) {
                $newArray[] = ['elem' => 'img', 'v' => $inputImg[$i], 'code' => $this->getRandomString()];
            } else {
                if (!empty($img[$i])) {
                    $fileName = $this->fileService->storeFileInServerVk($img[$i]);
                    $newArray[] = ['elem' => 'img', 'v' => $fileName, 'code' => $this->getRandomString()];
                }
            }
        }

        return $newArray;
    }

    /**
     * @return string
     */
    public function getRandomString(): string
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 16);
    }

    /**
     * @param int $id
     * @param array $elem
     */
    public function updateElements(int $id, array $elem): void
    {
        $jsonRecipe = collect($elem)->toJson();
        $this->recipeRepository->updateElements($id, $jsonRecipe);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id): void
    {
        $this->recipeRepository->destroy($id);
    }

    /**
     * @param $arr1
     * @param $arr2
     * @param $arr3
     * @return mixed
     */
    public function getMaxKey($arr1, $arr2, $arr3)
    {
        $arr = [];
        if (count($arr1)) {
            $arr[] = max(array_keys($arr1));
        }
        if (count($arr2)) {
            $arr[] = max(array_keys($arr2));
        }
        if (count($arr3)) {
            $arr[] = max(array_keys($arr3));
        }
        count($arr) ? $maxKey = max($arr) : $maxKey = 0;

        return $maxKey;

    }

    /**
     * @param string $search
     * @return object
     */
    public function searchEveryWhereOnRequest(string $search): object
    {
        return $this->recipeRepository->searchEveryWhereOnRequest($search);
    }

    /**
     * @param Request $request
     */
    public function deleteImg(Request $request)
    {
        $id = (int)$request->id;
        $recipe = $this->show($id); // Получили материал по id
        $elements = json_decode($recipe->elements); // Декодировали элементы в массив
        $code = $request->file;
        $newArray = [];
        if (!empty(count($elements))) {
            foreach ($elements as $element) {
                if ($element->code !== $code) {
                    $newArray[] = $element;
                }
            }
        }
        $this->updateElements($id, $newArray);
    }
}