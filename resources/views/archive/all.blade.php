@extends('layouts.app')
@section('content')
    <script src="{{asset("js/fontawesome/fontawesome5.js")}}"></script>

    <div class="container-fluid">
        <div class="row justify-content-center ">
            <div class="col">
                @if (!empty(count($data)))
                    <table style="text-align: left; font-size: 11px;" class="table">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Прибывание</th>
                            <th scope="col">Отзыв</th>
                            <th scope="col">Инфо</th>
                            <th scope="col">Сумма</th>
                            <th scope="col">Подтверждено</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($data as $value)
                            <tr>
                                <th scope="row"> {{ $value->id }}</th>
                                <th scope="row"><i class="fas fa-user-alt"></i> {{ $value->user_id }}</th>
                                <th scope="row"><i class="fas fa-indent"></i> {{ substr($value->date_book, 0, 20) }}...
                                   </th>

                                <th scope="row"><i class="fas fa-comments"></i> {{ $value->comment }}</th>
                                <th scope="row"><i class="fas fa-users"></i> {{ $value->user_info }}</th>
                                <th scope="row"><i class="fas fa-ruble-sign"></i> {{ $value->total }}</th>
                                <th scope="row"><i class="fas fa-check"></i> {{ $value->confirmed }}</th>
                                <th scope="row">
                                    <a onClick="return confirm('Подтвердите удаление!')"
                                       title="Удалить"
                                       href='{{route('admin.delete.archive', ['id' => $value->id])}}' type='button'
                                       class='btn btn-outline-danger btn-sm' style="margin: 5px">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    Архив пуст
                @endif
            </div>
        </div>
    </div>


@endsection
