@extends('layouts.app')
@section('content')

    @php
        header("Referrer-Policy: no-referrer-when-downgrade");
    @endphp


    <div class="container mt-5 mb-5">
        <form id="oplata" action="/q_pay" method="POST">
            @csrf
            <label for="id"><b>Номер бронирования:</b></label><br>
            <input name="id" value="{!!$data->id!!}" class="form-control" readonly="readonly"/><br>

            <label for="date_book"><b>Даты:</b></label><br>
            <input name="date_book" value="{!!$data->no_in !!} - {!!$data->no_out!!}"
                   class="form-control" readonly="readonly"/><br>


            <label for="total"><b>Сумма:</b></label><br>
            <input name="total" value="{!!$data->total!!} руб." class="form-control" readonly="readonly"/><br>


            <label for="amount"><b>20% к предоплате:</b></label><br>
            <input name="amount" value="{!!$c_pay!!} руб." class="form-control" readonly="readonly"/><br>

            <input type="hidden" name="billId" value="{!!$billId!!}"/><br>
            <br>
            <br>
            <button class="btn btn-outline-info" type="submit" form="oplata">Оплатить</button>
        </form>
        <br>
    </div>


@endsection
