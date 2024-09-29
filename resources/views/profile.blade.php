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
                                {{ $value ['no_in']  }} - {{ $value['no_out']  }}
                            </div>
                            @php
                            $res = explode(',', $value['user_info'])
                            @endphp

                            <div class="card-body">
                                №: {{ $value['id']  }} <br>
                                ФИО: {{ $res[1] }} <br>
                                Сумма: {{  $value ['total'] }} <br><br>
                            </div>

                            <div class="card-footer text-muted">
                                @if (!empty($value['confirmed']) == 0)
                                    Статус: Не подтверждён <br>
                                @else
                                    Статус: Подтверждён <br>
                                @endif
                                <br>
                                <a onClick="return confirm('Подтвердите удаление! :(( Если была внесена предоплата, она не возвращается...')"
                                   href="{{ route('order.delete', ['id' => $value['id']]) }}" type='button'
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
