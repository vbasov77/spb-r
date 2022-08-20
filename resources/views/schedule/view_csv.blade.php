@extends('layouts.app')
@section('content')


    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">

                    <h2>Работа с файлами .CSV</h2>
                    <div class="card" style="margin: 20px">
                        <div class="card-header">
                            Сформировать файл .CSV
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Выберете даты</h5>
                            <form action="/get_csv" method="post">
                                @csrf
                                <div>
                                    <input id="input-id" name="date_book" type="text"
                                           class="form-control text-center"

                                           placeholder="Нажмите для выбора даты" autocomplete="off"
                                           required>

                                    <br>
                                </div>

                                <div class="card-footer">
                                    <div>
                                        <input class="btn btn-success btn-sm" type="submit" style="color: white"
                                               value="Продолжить">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card" style="margin: 20px">
                        <div class="card-header">
                            Загрузить файл .CSV
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Загрузите файл CSV</h5>
                            <form action="/update_csv" method="post" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <input type="file" name="file"><br>
                                    <br>
                                </div>

                                <div class="card-footer">
                                    <div>
                                        <input class="btn btn-success btn-sm" type="submit" style="color: white"
                                               value="Загрузить">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="{{ asset('js/calendars/schedule_cal3.js') }}" defer></script>
    </section>








@endsection
