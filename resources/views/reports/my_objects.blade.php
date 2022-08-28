@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    @if(!empty(count($data)))
                        @foreach($data as $value)
                            <div class="card text-center" style="margin: 15px">
                                <div class="card-header">
                                    ID {{$value->id}}
                                </div>
                                <div class="card-body">
                                    <h4>{{$value->address}}</h4>
                                </div>
                                <div class="card-footer text-muted">
                                    <button class="btn btn-outline-success btn-sm"
                                            style="margin: 5px"
                                            onclick="window.location.href = '{{route('my.obj', ['id'=> $value->id])}}';">
                                        Подробнее
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        Объектов не найдено...
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
