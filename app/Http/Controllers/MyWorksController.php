<?php

namespace App\Http\Controllers;


use App\Models\WorkImages;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class MyWorksController extends Controller
{
    public function view(Request $request)
    {
        $work = Work::where('id', $request->id)->get();
        $slider = WorkImages::where('work_id', $request->id)->get();
        $backend = explode(',', $work[0]->backend);

        return view('my_works.view', ['work' => $work[0], 'backend' => $backend, 'slider' => $slider]);
    }


    public function viewAll()
    {
        $themes = Themes::all();
        return view('themes.view_all', ['themes' => $themes]);
    }

    public function edit(Request $request)
    {
        if (!empty($request->file())) {
            Storage::delete('public/images/' . $request->image);
            $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';// Случайные символы
            $code_theme = substr(str_shuffle($code), 0, 16);// Сгенерировали случайное имя для файлов

            $guessExtension_image = $request->file('new_image')->guessExtension();// получили расширение фото
            //Записываем файлы
            $path_img = $code_theme . "." . $guessExtension_image;
            $request->file('new_image')->storeAs('images', $code_theme . '.' . $guessExtension_image, 'public');

        } else {
            $path_img = $request->image;
        }

        $backend = preg_replace("/\s+/", "", $request->backend);
        $work = [
            'name' => $request->name,
            'text' => $request->text,
            'description' => $request->description,
            'link' => $request->link,
            'backend' => $backend,
            'image' => $path_img,
        ];
        Work::where('id', $request->id)->update($work);
        return redirect(route('work.id', ['id' => $request->id]));
    }

    public function add(Request $request)
    {

        $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';// Случайные символы
        $code_theme = substr(str_shuffle($code), 0, 16);// Сгенерировали случайное имя для файлов
        $guessExtension_image = $request->file('image')->guessExtension();// получили расширение фото
        //Записываем файлы
        $path_img = $code_theme . "." . $guessExtension_image;
        $request->file('image')->storeAs('images', $code_theme . '.' . $guessExtension_image, 'public');
        $backend = preg_replace("/\s+/", "", $request->backend);
        $id = Work::insertGetId([
            'name' => $request->name,
            'text' => $request->text,
            'description' => $request->description,
            'link' => $request->link,
            'backend' => $backend,
            'image' => $path_img,
        ]);

        return redirect(route('work.id', ['id' => $id]));
    }

    public function viewAdd()
    {
        return view('my_works.add');
    }

    public function setSliderPhoto(Request $request)
    {
// Загрузка фото Ajax с использованием dropzone + добавление в BD
        if (!empty($request->file())) {
            $image = $request->file('file');
            // Допустимые символы для уникального имени файла
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $file = $request->file('file');
            // Создаём уникальное имя для файла
            $filename = substr(str_shuffle($permitted_chars), 0, 16) . '.' . $file->extension();
            // Добавление файла в папку public
            $image->move(public_path('images/slider'), $filename);
            // Записываем имя файла в BD
            WorkImages::insert([
                'work_id' => $request->id,
                'path' => $filename,

            ]);
            // Получаем все фото объекта
            $result = WorkImages::where('work_id', $request->id)->get();
            foreach ($result as $value) {
                $array[] = $value->path;
            }
            $data = implode(',', $array);
            $fil = (string)$data;
            $res = ['answer' => 'ok', 'fil' => $fil];
        } else {
            $res = ['answer' => 'error', 'mess' => 'Ошибка'];
        }
        exit(json_encode($res));
    }

    public function deleteDrop(Request $request)
    {
        // Удаление файла фото из public и из BD
        if ($request->get('file')) {
            $file = $request->get('file');
            File::delete(public_path('images/slider/' . $request->get('file')));// Удалили файл
            WorkImages::where('work_id', $request->id)->where('path', $file)->delete();// Удалили из БД
        }
    }

    public function editView(Request $request)
    {
        $work = Work::where('id', $request->id)->get();
        $photo_slider = WorkImages::where('work_id', $request->id)->get();
        $images = null;
        if (!empty(count($photo_slider))) {
            foreach ($photo_slider as $value) {
                $images[] = $value->path;
            }
        }
        return view('my_works.edit', ['work' => $work[0], 'images' => $images]);
    }
}
