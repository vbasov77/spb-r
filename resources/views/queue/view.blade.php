@extends('layouts.app')
@section('content')


    {{--    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>--}}
    <div class="container-fluid">
        <div class="row justify-content-center ">
            <div class="col">
                <h3>Очереди</h3>
                <div class="container picker">
                    <div style="margin-top: 40px; height: 250px">
                        <center>
                            <input id="input-id" type="text">
                        </center>
                    </div>
                </div>
                <div class="container">
                    <div class="p">
                        @if (!empty(count($data)))
                            <table style="text-align: left" class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Въезд</th>
                                    <th scope="col">Выезд</th>
                                    <th scope="col">Ночей</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">Телефон</th>
                                    <th scope="col">Мессенджер</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data['queue'] as $queue)
                                    <tr>
                                        <th scope="row"> {!! date('d.m.Y', $queue->date_in) !!}</th>
                                        <th scope="row"> {!! date('d.m.Y', $queue->date_out) !!}</th>
                                        <th scope="row"> {!! $queue->count_night !!} </th>
                                        <th scope="row"> {!! $queue->name !!}</th>


                                        <th scope="row"> {!! $queue->phone  !!}<br>

                                            <button class="btn btn-outline-success"
                                                    onclick="window.location.href =
                                                            'https://wa.clck.bar/{{preg_replace('/[^0-9]/', '',
                                                         $queue->phone)}}';">
                                                <i class="fab fa-whatsapp"></i></button>

                                            <button class="btn btn-outline-info"
                                                    onclick="window.location.href = 'https://t.me/+{{
                                                        preg_replace('/[^0-9]/', '', $queue->phone)}}';">
                                                <i class="fab fa-telegram-plane"></i>
                                            </button>

                                            <button class="btn btn-outline-info"
                                                    onclick="window.location.href = 'tel:+{{
                                                        preg_replace('/[^0-9]/', '', $queue->phone)}}';"><i
                                                        class="fas fa-phone-alt"></i></button>

                                        </th>

                                        <th scope="row"> {!! $queue->messenger !!} </th>

                                        <th scope="row">
                                            <a href='{{route('update.queue', ['id' => $queue->id])}}' type='button'
                                               class='btn btn-outline-success btn-sm' style="margin: 5px">
                                                <i class="fas fa-user-edit"></i>
                                            </a>

                                            <a onClick="return confirm('Подтвердите удаление!')"
                                               href='{{route('delete.queue', ['id' => $queue->id])}}' type='button'
                                               class='btn btn-outline-danger btn-sm' style="margin: 5px">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>


                                        </th>
                                        <br>
                                    </tr>
                                @endforeach

                                </tbody>
                                <br>
                            </table>
                        @endif
                    </div>
                </div>


            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('js/fontawesome/fontawesome5.js') }}" defer></script>
            <script>
                var datebook = @json($data ['dateBook']);
            </script>

            <script src="{{ asset('js/calendars/calendar.js') }}" defer></script>
    @endpush
@endsection
