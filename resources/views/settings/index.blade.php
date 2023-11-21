@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="card" style="margin: 20px">
                        <div class="card-header">
                            Расписание
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Редактировать расписание календаря</h5>
                            <div class="card-footer">
                                <button class="btn btn-success btn-sm" style="color: white; margin-top: 25px"
                                        onclick="window.location.href = '{{route('admin.schedule.add')}}';">
                                    Добавить
                                </button>
                                <button class="btn btn-info btn-sm" style="color: white; margin-top: 25px"
                                        onclick="window.location.href =  '{{ route('admin.edit.schedule.mass')}}';">
                                    Изменить массово
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="margin: 20px">
                        <div class="card-header">
                            Главная
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Главная страница</h5>
                            <p class="card-text">Первый месяц & цена, Второй месяц & цена...</p>
                            <div class="card-footer">
                                <button class="btn btn-outline-success"
                                        onclick="window.location.href = '{{route("admin.front.edit")}}';">Редактировать
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
