@extends('layouts.create_material')
@section('content')
    <link href="{{ asset('css/checkbox/radio.css') }}" rel="stylesheet">
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <br>
                    @if (!empty($message))
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                    @endif
                    <h1 style="margin: 40px 0 60px 0">Выберете объект</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('admin.save.obj')}}" method="post">
                        @csrf
                        @if(!empty($obj))
                            @foreach($obj as $value)
                                <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                                    <input type='radio' id="initial{{$value->id}}" name="id" value="{{$value->id}}" required
                                    ><label for='initial{{$value->id}}'>{{$value->address}}</label></div>
                            @endforeach
                        @endif
                        <br>
                        <br>
                        <button class="btn btn-outline-success btn-sm" id="submit" type="submit">Перейти</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
