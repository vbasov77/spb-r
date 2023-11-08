@extends('layouts.app')
@section('content')


    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                @if(!empty(count($data)))
                    <form action="{{route("admin.edit.table")}}" method="post">
                        @csrf

                        <table class="table">

                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Дата</th>
                                <th scope="col">Цена</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $value)
                                <tr>
                                    <th scope="row"> {!!  $value->id!!}</th>
                                    <td>{!!  $value->date_book!!}</td>
                                    <td>
                                        <input type="text" name="cost[]"
                                               value="{!!  (int)$value->cost !!}">
                                        <input type="hidden" name="id[]" value="{{$value->id}}">
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                        <div>
                            <input class="btn btn-outline-primary" type="submit" value="Изменить">
                        </div>
                    </form>
                @endif
            </div>
        </div>

    </section>
@endsection
