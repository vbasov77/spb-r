@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <form action="{{route("admin.update.archive")}}" method="post">
                        @csrf
                        <h3> Изменить архив</h3>
                        <br>
                        <input type="hidden" name="id" value="{{$archive->id}}">
                        <input type="hidden" name="user_id" value="{{$archive->user_id}}">
                        <div class="size">
                            <label for="date_in"><b>Дата въезда:</b></label>
                            <input name="date_in" type="date" class="form-control"
                                   value="{{date('Y-m-d', strtotime($archive->date_in))}}"
                                   required>
                        </div>
                        <br>

                        <label for="date_out"><b>Дата выезда:</b></label>
                        <input name="date_out" type="date" class="form-control"
                               value="{{date('Y-m-d', strtotime($archive->date_out))}}"
                               required>

                        <br>
                        <label for="user_info"><b>User info:</b></label>
                        <input name="user_info" type="text" class="form-control"
                               value="{{$archive->user_info}}"
                               placeholder="О юзере..." required>
                        <br>
                        <label for="total"><b>Итого:</b></label>
                        <input name="total" type="number" class="form-control"
                               value="{{$archive->total}}"
                               placeholder="Итого..." required>
                        <br>
                        <label for="comment"><b>Коммент:</b></label>
                        <input name="comment" type="text" class="form-control"
                               value="{{$archive->comment}}"
                               placeholder="Коммент..." required>
                        <br>

                        <div>

                            <input class="btn btn-outline-success" type="submit" value="Изменить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
