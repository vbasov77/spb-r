<li class="has-children">
    <a href="#">Добавить</a>
    <ul class="dropdown">
        <li>
            <a class="dropdown-item" href="{{route('create.news')}}">Новость</a>
            <a class="dropdown-item" href="{{route('admin.create.place')}}">Место</a>
            <a class="dropdown-item" href="{{route('admin.view_add_order_is_admin')}}">Бронь</a>
            <a class="dropdown-item" href="{{route('admin.missed.dates')}}">Упущенные даты</a>
            <a class="dropdown-item" href="{{route('admin.create.obj')}}">Объект</a>
            <a class="dropdown-item" href="{{route('admin.in.queue')}}">В очередь</a>
        </li>
    </ul>
</li>
<li class="has-children">
    <a href="#">Материалы</a>
    <ul class="dropdown">
        <li>
            <a class="dropdown-item" href="{{route('admin.create.material')}}">Добавить</a>
            <a class="dropdown-item" href="{{route('admin.get.obj')}}">Все материалы</a>
            <a class="dropdown-item" href="{{route('admin.find.it.everywhere')}}">Искать везде</a>
        </li>
    </ul>
</li>
<li class="has-children">
    <a href="#">Заметки</a>
    <ul class="dropdown">
        <li>
            <a class="dropdown-item" href="{{route('articles')}}">Все заметки</a>
            <a class="dropdown-item" href="{{route('admin.create.article')}}">Добавить</a>
        </li>
    </ul>
</li>
<li class="has-children">
    <a href="#">Калькуляторы</a>
    <ul class="dropdown">
        <li>
            <a class="dropdown-item" href="{{route('omega3Calculator')}}">Омега3</a>
            <a class="dropdown-item" href="{{route('productsCalculator')}}">Продуктов за кг</a>
            <a class="dropdown-item" href="{{route('productSumPacCalculator')}}">Продуктов за уп-у</a>
        </li>
    </ul>
</li>
<li class="has-children">
    <a href="#">Рецепты</a>
    <ul class="dropdown">
        <li>
            <a class="dropdown-item" href="{{route('recipes')}}">Все рецепты</a>
            <a class="dropdown-item" href="{{route('create.recipe')}}">Добавить рецепт</a>
        </li>
    </ul>
</li>
<li>
    <a class="dropdown-item" href="{{route('admin.settings')}}">Настройки</a>
    <a class="dropdown-item" href="{{route('admin.orders')}}">Заказы</a>
    <a class="dropdown-item" href="{{route('admin.view.queue')}}">Очереди</a>
    <a class="dropdown-item" href="{{route('reports')}}">Отчёты</a>
    <a class="dropdown-item" href="{{route('admin.archive')}}">Архив</a>
    <a class="dropdown-item" href="{{route('admin.del.schedule')}}">Очистить базу</a>
    <a class="dropdown-item" href="{{route('list.places')}}">Куда сходить</a>
    <a class="dropdown-item" href="{{route('admin.files')}}">Файлы</a>
</li>
<li class="has-children">
    <a href="#">Парсеры</a>
    <ul class="dropdown">
        <li>
            <a class="dropdown-item" href="{{route('admin.parser.view-wallGroupsNews')}}">Стены групп</a>
        </li>
    </ul>
</li>

