@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>База данных очищена</h1>
        <font color='#99b1c6'><i class="fas fa-cat fa-5x"></i></font>
        <br>
        <h2>Очищено {{ $count }} записей...</h2>
        <br>
        <br>
    </div>
    {{--    <meta http-equiv="refresh" content="7; url= / ">--}}
@endsection
