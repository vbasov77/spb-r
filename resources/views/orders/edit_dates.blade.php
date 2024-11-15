@extends('layouts.app')
@section('content')
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Изменить даты</h3>
                    @if($errors->any())
                        @foreach($errors -> all() as $error)
                            <x-alert type="danger" :message="$error"/>
                        @endforeach
                    @endif
                    <form id="form" action="{{route("admin.update.dates")}}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div>
                            <label for="date_in"><b>Дата въезда:</b></label>
                            <input name="date_in" type="date"
                                   class="form-control"
                                   value="{{date('Y-m-d', strtotime($data->no_in))}}"
                                   required>
                        </div>
                        <br>
                        <div>
                            <label for="date_out"><b>Дата выезда:</b></label>
                            <input name="date_out" type="date"
                                   class="form-control"
                                   value="{{date('Y-m-d', strtotime($data->no_out))}}"
                                   required>
                        </div>
                        <br>
                        <div>
                            <input class="btn btn-outline-primary" id="submit" type="submit" value="Продолжить">
                        </div>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
