@extends('layouts.app')
@section('content')
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>

    <div class="container">

        <h1>Спасибо за бронирование!</h1>

        <font color='#99b1c6'><i class="fas fa-cat fa-5x"></i></font>
        <br>
        <?= $mess?>
        <br>
        <br>



    </div>

    {{--    <meta http-equiv="refresh" content="7; url= / ">--}}
@endsection
