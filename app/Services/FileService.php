<?php


namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService extends Service
{
    private $imgPlService;


    public function __construct()
    {
        $this->imgPlService = new ImgPlaceService();
    }

    public function addFile(object $file): string
    {
        $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';// Случайные символы
        $codeTheme = substr(str_shuffle($code), 0, 16);// Сгенерировали случайное имя для файлов
        $guessExtensionImage = $file->guessExtension();// получили расширение фото
        $fileName = $codeTheme . '.' . $guessExtensionImage;

        //Записываем файлы
        $file->storeAs('images/news', $fileName, 'public');

        return $fileName;
    }

    public function storeFileInPublic(object $image, int $placeId)
    {
        if (!empty($image)) {
            // Допустимые символы для уникального имени файла
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Создаём уникальное имя для файла
            $fileName = substr(str_shuffle($permitted_chars), 0, 16) . '.' . $image->extension();

            // Добавление файла в папку public
            $image->move(public_path('images/places'), $fileName);

            $this->imgPlService->store((string)$fileName, (int)$placeId);

            return $fileName;
        }

    }

    public function destroyImg(array $file)
    {
        File::delete(public_path('images/places/' . $file['path']));
    }

    public function destroyImgStr(string $path)
    {
        File::delete(public_path('images/places/' . $path));
    }

    public function destroyFile(string $fileName)
    {
      Storage::delete('public/folder/' . $fileName);
    }


}