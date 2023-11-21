@extends('layouts.app')
@section('content')

    <div class="container mt-5 mb-5">

        <h3>Проверкае данных:</h3><br>

        Id: {{$data->id}}<br>
        Даты: {{ $data->no_in . ' - ' . $data->no_out}} <br>
        ФИО: {{ $data->name }} <br>
        Телефон: {{ $data->phone }} <br>
        Email: {{ $data->email }} <br>
        Сумма: {{ $data->total }} <br>
        Статус: @if (!empty($data->pay == 0))
            Не оплачен<br>
        @else:
            Оплачен<br>
            @php
                $os = explode(';', $data->info_pay);
                $ost = $data->total - $os[2];
            @endphp
            Остаток: {{ $ost}} руб.<br>
        @endif
        Ночей: {{ $nights}}<br>
        <br>
        Гости:<br>
        @foreach ($userInfo as $item)
            <div>
                {{ $item }} <br>
            </div>
        @endforeach
        <br>

        @if (!empty(count($info)))
            @foreach($info as $item)
                {!!  $item !!}<br>
            @endforeach
        @endif
        <br>
        <br>
        @if($data->confirmed == 0)<br>
        <div>

            <a onClick="return confirm('Подтвердите подтверждение!')" style="margin: 5px"
               href='{{route('admin.order.confirm', ['id'=>$data->id])}}' type='button'
               class="btn btn-outline-success btn-sm">Подтвердить</a>

            <a onClick="return confirm('Подтвердите отклонение!')" style="margin: 5px"
               href='{{route('admin.order.reject', ['id'=>$data->id])}}' type='button'
               class="btn btn-outline-secondary btn-sm">Отклонить</a>

        </div>
        @endif
        @if($data->confirmed == 1)
            <button class="btn btn-outline-success btn-sm"
                    onclick="window.location.href = '{{route('admin.order.to_pay', ['id'=>$data->id])}}';">
                Внести
            </button>
        @endif
    </div>
@endsection
