@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-header">
                            Заказы
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Посмотреть предварительные заказы</h5>

                            <div class="card-footer">
                                <button class="btn btn-outline-success"
                                        onclick="window.location.href = '{{route('admin.orders')}}';">Перейти
                                </button>
                            </div>

                        </div>
                    </div>




                </div>
            </div>
        </div>
    </section>

@endsection
