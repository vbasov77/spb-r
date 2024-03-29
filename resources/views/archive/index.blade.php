@extends('layouts.app')
@section('content')

    <div class="container mt-5 mb-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8">

                <div class="card text-center" style="margin: 15px">
                    <div class="card-header">
                        {!!$data['no_in']!!} - {!!$data['no_out']!!}
                    </div>

                    <div class="card-body">
                        №: {!!$data['id']!!} <br>
                        ФИО: {!!$data ['user_name']!!} <br>
                        Телефон: {!!$data['phone']!!} <br>
                        Email: {!!$data['email']!!} <br>
                        Сумма: {!!$data ['total']!!} <br>
                        Гости: {!!$data ['user_info']!!} <br>
                        Отзыв: {!!$data ['comment']!!} <br>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
