@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3> Редактировать новость </h3>
                    <form action="{{route("admin.update.news")}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$news->id}}">
                        <br>
                        <div>
                            <label for="text">Текст</label>
                            <textarea id="text" rows='10' type="text" placeholder="Текст" class="form-control"
                                      name="text"
                                      required
                            >{{$news->text ?? old("text")}}</textarea><br>
                        </div>
                        <br>
                        <div>
                            <input class="btn btn-outline-primary" type="submit" value="Изменить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
