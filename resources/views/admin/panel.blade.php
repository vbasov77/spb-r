@extends('layouts.app')
@section('content')
    <style>
        .btn {
            margin-bottom: 7px;
        }
    </style>
    <div class="container-fluid">
        <div style="margin-top: 50px" class="row justify-content-center">
            <div class="col-xl-4 col-md-6 col-sm-12">
                <h4>Добавить</h4>
                <a class="btn btn-outline-success btn-sm" href="{{route('create.news')}}">Новость</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.create.place')}}">Место</a><br>
                <a class="btn btn-outline-success btn-sm"
                   href="{{route('admin.view_add_order_is_admin')}}">Бронь</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.missed.dates')}}">Упущенные даты</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.create.obj')}}">Объект</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.in.queue')}}">В очередь</a><br>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <h4>Материалы</h4>
                <a class="btn btn-outline-info btn-sm" href="{{route('admin.create.material')}}">Добавить</a><br>
                <a class="btn btn-outline-info btn-sm" href="{{route('admin.get.obj')}}">Все материалы</a><br>
                <a class="btn btn-outline-info btn-sm" href="{{route('admin.find.it.everywhere')}}">Искать везде</a><br>
                <br>
                <br>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <h4>Заметки</h4>
                <a class="btn btn-outline-info btn-sm" href="{{route('articles')}}">Все заметки</a><br>
                <a class="btn btn-outline-info btn-sm" href="{{route('admin.create.article')}}">Добавить</a><br>
                <br>
                <br>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <h4>Меню</h4>
                <small>Недвижимость. Сдача.</small><br><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.settings')}}">Настройки</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.orders')}}">Заказы</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.view.queue')}}">Очереди</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('reports')}}">Отчёты</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.archive')}}">Архив</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.del.schedule')}}">Очистить базу</a><br>
                <a class="btn btn-outline-success  btn-sm" href="{{route('list.places')}}">Куда сходить</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.files')}}">Файлы</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.front.general')}}">Главная</a><br>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <h4>Калькуляторы</h4>
                <a class="btn btn-outline-success btn-sm" href="{{route('omega3Calculator')}}">Омега3</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('productsCalculator')}}">Продуктов за кг</a><br>
                <a class="btn btn-outline-success btn-sm" href="{{route('productSumPacCalculator')}}">Продуктов за уп-ку</a><br>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <h4>Парсеры</h4>
                <a class="btn btn-outline-success btn-sm" href="{{route('admin.parser.view-wallGroupsNews')}}">Стены
                    групп</a><br>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <h4>Рецепты</h4>
                <a class="btn btn-outline-success btn-sm" href="{{route('recipes')}}">Все рецепты</a><br>
                <a class="btn btn-outline-success btn-sm"href="{{route('create.recipe')}}">Добавить рецепт</a><br>
            </div>
        </div>
    </div>
@endsection
