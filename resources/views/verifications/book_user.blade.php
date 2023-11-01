@extends('layouts.app')
@section('content')

    <div class="container mt-5 mb-5">

        <h3>Проверкае данных:</h3><br>

        Id: {!!$res->id!!}<br>
        Даты: {!! $res->no_in . ' - ' . $res->no_out!!} <br>
        ФИО: {!! $res->user_name !!} <br>
        Телефон: {!! $res->phone !!} <br>
        Email: {!! $res->email !!} <br>
        Сумма: {!! $res->total !!} <br>
        Статус: @if (!empty($res->pay == 0))
            Не оплачен<br>
        @else:
            Оплачен<br>
            @php
                $os = explode(';', $res->info_pay);
                $ost = $res->total - $os[2];
            @endphp
            Остаток: {!! $ost;!!} руб.<br>
        @endif
        Ночей: {!! $nights!!}<br>
        <br>
        Гости:<br>
        @foreach ($userInfo as $item)
            <div>
                {!! $item !!} <br>
            </div>
        @endforeach
        <br>

        @if (!empty(count($info)))
            @foreach($info as $item)
                {!! $item!!}<br>
            @endforeach
        @endif
        <br>
        <br>
        @if($res->confirmed == 0)<br>
        <div>

            <a onClick="return confirm('Подтвердите подтверждение!')" style="margin: 5px"
               href='{{route('admin.order.confirm', ['id'=>$res->id])}}' type='button'
               class="btn btn-outline-success btn-sm">Подтвердить</a>

            <a onClick="return confirm('Подтвердите отклонение!')" style="margin: 5px"
               href='{{route('admin.order.reject', ['id'=>$res->id])}}' type='button'
               class="btn btn-outline-secondary btn-sm">Отклонить</a>

        </div>
        @endif
        @if($res->confirmed == 1)
            <button class="btn btn-outline-success btn-sm"
                    onclick="window.location.href = '{{route('order.to_pay', ['id'=>$res->id])}}';">
                Внести
            </button>
        @endif
    </div>
@endsection
