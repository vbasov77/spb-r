@extends('layouts.app')
@section('content')


    <div class="container">
        <center>
            <div style="font-size: 150px; opacity: .8; color: #2fa360">
                <i class="far fa-frown"></i>
            </div>
            <div style="margin-top: 40px">
                <h3>Извините, что-то пошло не так.<br>
                    Скорее всего вы уже забронировали этот номер.<br>
                    Зайдите в свой личный кабинет или свяжитесь с администратором</h3>
            </div>
        </center>
        <br>
        <center>
            <button class="btn btn-outline-success btn-sm" onclick="window.location.href = 'https://wa.clck.bar/79110120912';">
                <i class="fab fa-whatsapp"></i> по WhatsApp
            </button>
        </center>
        <br>
        @if(empty(\Illuminate\Support\Facades\Auth::check()))

            <a class="btn btn-primary btn-sm" href="{{ route('login') }}">{{ __('Login') }}</a>

            @if (Route::has('register'))

                <a class="btn btn-danger btn-sm" href="{{ route('register') }}">{{ __('Register') }}</a>

            @endif
        @endif
        <br>
    </div>


@endsection
