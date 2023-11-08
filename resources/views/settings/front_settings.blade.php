@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Редактировать главную страницу</h3>
                    <form action="{{route("admin.front.edit")}}" onsubmit="return Validate(this);"
                          enctype="multipart/form-data" method="post">
                        @csrf
                        <div>
                            <label><b>Первый месяц</b><i>Через запятую</i></label><br>
                            <input class="form-control" value="{{$data[0]}}" type="text"
                                   name="data[]"
                                   required><br>
                        </div>

                        <div>
                            <label><b>Второй месяц</b> <i>Через запятую</i></label><br>
                            <input class="form-control" value="{{$data[1]}}" type="text"
                                   name="data[]"
                                   required><br>
                        </div>

                        <div>
                            <input class="btn btn-outline-success" type="submit" value="Сохранить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push("scripts")
        <script src="{{ asset('js/checks/check_file.js') }}" defer></script>
    @endpush
@endsection
