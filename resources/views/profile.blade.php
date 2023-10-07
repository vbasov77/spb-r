@extends('layouts.app')
@section('content')
    <style>
        .card.text-center {
            padding: 15px;
            margin: 15px;
        }
    </style>
    <!--    --><?php
    //
    //    var_dump($data ['book']);
    //    return;
    //    ?>

    <div class="container mt-5 mb-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8">
                <h4>Мои бронирования</h4>
                @if(!empty(count($data)))
                    @foreach ($data as  $value)
                        <div class="card text-center" style="margin: 15px">
                            <div class="card-header">
                                {!! $value ['no_in']  !!} - {!! $value['no_out']  !!}
                            </div>

                            <div class="card-body">
                                №: {!! $value['id']  !!} <br>
                                ФИО: {!! $value ['user_name'] !!} <br>
                                Телефон: {!! $value['phone'] !!} <br>
                                Email: {!!  $value['email'] !!} <br>
                                Сумма: {!!  $value ['total'] !!} <br><br>
                            </div>

                            <div class="card-footer text-muted">
                                @if (!empty($value['confirmed']) == 0)
                                    Статус: Не подтверждён <br>
                                @else
                                    Статус: Подтверждён <br>
                                @endif
                                @if (!empty($value['confirmed']) == 1)
                                    Предоплата:
                                    @if (!empty($value['pay']) == 0)
                                        Не внесена <br>
                                        <button class="btn btn-outline-success" style="margin: 10px"
                                                onclick="window.location.href = '/q_pay/{{$value['id']}}/pay';">Внести
                                        </button>
                                    @else
                                        @php $ost = explode(';', $value['info_pay']);
                                $ostatok = $value ['total'] - $ost [2];
                                        @endphp
                                        Внесена <br>
                                        Остаток: {!!  $ostatok !!} Руб.
                                        <br>


                                    @endif
                                @endif
                                <br>
                                <a onClick="return confirm('Подтвердите удаление! :(( Если была внесена предоплата, она не возвращается...')"
                                   href='/ord/{{$value['id']}}/delete' type='button'
                                   style="margin: 10px"
                                   class='btn btn-outline-danger btn-sm'>Отменить</a>
                                <br>
                            </div>
                        </div>
                    @endforeach
                @else
                    Бронирования не найдены...
                @endif
            </div>
        </div>
    </div>

@endsection
