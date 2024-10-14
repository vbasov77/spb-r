<li class="has-children">
    <a href="#">Добавить</a>
    <ul class="dropdown">
        <a class="dropdown-item" href="{{route('create.news')}}">Новость</a>
        <a class="dropdown-item" href="{{route('admin.create.place')}}">Место</a>
        <a class="dropdown-item" href="{{route('admin.view_add_order_is_admin')}}">Бронь</a>
        <a class="dropdown-item" href="{{route('admin.in.queue')}}">В очередь</a>
    </ul>
</li>
<li>

    <a class="dropdown-item" href="{{route('admin.settings')}}">Настройки</a>
    <a class="dropdown-item" href="{{route('admin.orders')}}">Заказы</a>
    <a class="dropdown-item" href="{{route('admin.view.queue')}}">Очереди</a>
    <a class="dropdown-item" href="{{route('admin.reports')}}">Отчёты</a>
    <a class="dropdown-item" href="{{route('admin.archive')}}">Архив</a>
    <a class="dropdown-item" href="{{route('admin.del.schedule')}}">Очистить базу</a>
    <a class="dropdown-item" href="{{route('list.places')}}">Куда сходить</a>
    <a class="dropdown-item" href="{{route('admin.files')}}">Файлы</a>


</li>
<li class="has-children">
    <a href="#">Парсеры</a>
    <ul class="dropdown">
        <a class="dropdown-item" href="{{route('admin.parser.view-wallGroupsNews')}}">Стены групп</a>
    </ul>
</li>

