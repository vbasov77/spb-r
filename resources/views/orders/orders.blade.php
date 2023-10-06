@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Бронь</h3>

                    <div>
                        <input id="input-id" name="date_book" type="text"
                               class="form-control"
                               placeholder="Нажмите для выбора даты" autocomplete="off" readonly="readonly">
                    </div>
                    <br>

                    @if (!empty($data))
                        @for($i = 0; $i < count($data); $i++)

                            @php
                                $pay = explode(';', $data[$i]->info_pay);
                                $phone = preg_replace("/[^0-9]/", '', $data[$i]->phone);

                            @endphp

                            <div class="card text-center" style="margin: 15px">
                                <div class="card-header">
                                    Даты: {!!$data[$i]->no_in!!} - {!! $data[$i]->no_out !!}<br>
                                </div>
                                <div class="card-body">
                                    Имя: {!! $data [$i]->user_name !!}<br>
                                    Телефон: <a href='tel:+{!! $phone !!}'> {!! $data [$i]->phone !!}</a><br>
                                    <button class="btn btn-outline-success btn-sm"
                                            onclick="window.location.href = 'https://wa.clck.bar/{{$phone}}';"><i
                                                class="fab fa-whatsapp"></i> по WhatsApp
                                    </button>
                                    <br>

                                    Сумма: {!! $data [$i]->total !!}<br>
                                    @if($pay [0] == 0)
                                        Не оплачен
                                    @else
                                        Оплачен
                                    @endif
                                    @if(!empty($data[$i]->archive))
                                        <br><small><i>Имеются отзывы:
                                                <div style="color: red">
                                                    {!!  $data [$i]->archive !!}
                                                </div>

                                            </i></small>
                                    @endif
                                </div>
                                <div class="card-footer text-muted">
                                    @if($data [$i]->confirmed == 0)<br>

                                    <a onClick="return confirm('Подтвердите подтверждение!')" style="margin: 5px"
                                       href='{{route('order.confirm', ['id'=>$data[$i]->id])}}' type='button'
                                       class="btn btn-outline-success btn-sm">Подтвердить</a>


                                    <a onClick="return confirm('Подтвердите отклонение!')" style="margin: 5px"
                                       href='/order/{{$data[$i]->id }}/reject' type='button'
                                       class="btn btn-outline-secondary btn-sm">Отклонить</a>

                                    <br>
                                    @endif
                                    <button class="btn btn-outline-warning btn-sm"
                                            style="margin: 5px"
                                            onclick="window.location.href = '/order/{{ $data[$i]->id }}/verification';">
                                        Подробнее
                                    </button>
                                    <button class="btn btn-outline-info btn-sm"
                                            style="margin: 5px"
                                            onclick="window.location.href = '/order/{{$data[$i]->id }}/edit';">
                                        Редактировать
                                    </button>
                                    <a onClick="return confirm('Подтвердите удаление!')"
                                       href='/order/{{$data[$i]->id}}/delete' type='button'
                                       class='btn btn-outline-danger btn-sm' style="margin: 5px">Удалить</a>
                                    <br>
                                    <br>
                                    <form action="/in_archive" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$data[$i]->id }}"/>
                                        <i>Отзыв администратора</i><br>
                                        <input type="text" name="otz" id="otz" class="form-control"
                                               placeholder="Отзыв администратора"/>
                                        <br>
                                        <div>
                                            <input id="submit" class="btn btn-outline-dark btn-sm" type="submit"
                                                   value="В архив"/>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        @endfor
                    @else

                        Заказов не найдено((
                    @endif
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            let datebook = @json($data2 ['date_book']);
        </script>
        <script src="{{ asset('js/calendar.js') }}" defer></script>
        <script src="{{ asset('js/otz.js') }}" defer></script>
    @endpush
@endsection
