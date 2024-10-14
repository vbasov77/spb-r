@extends('layouts.app')
@section('content')


    <div class="container">
        <center>
            <img style="width: 150px; height: auto; opacity: .8; margin-top: 50px" src="{{asset('icons/smile_e.svg')}}">

            <div style="margin-top: 40px">
                <h3>Что-то пошло не так.</h3>
            </div>
            <div>
                <b>{!! nl2br(e($message)) !!}</b>
                <br>
            </div>
        </center>
        <br>

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
