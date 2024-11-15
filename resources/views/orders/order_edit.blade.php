@extends('layouts.app')
@section('content')

    <style>
        input.tel {
            margin-bottom: 15px;
        }

        .is-invalid img {
            background-image: none;
        }
    </style>

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Редактировать заказ</h3>
                    @if($errors->any())
                        @foreach($errors -> all() as $error)
                            <x-alert type="danger" :message="$error"/>
                        @endforeach
                    @endif
                    <form action="{{route("admin.order.edit")}}" method="post">
                        @csrf
                        <input name="id" type="hidden" value="{{$order['id']}}">
                        <div class="border_none">
                            <label for="id"><b>ID заказа</b></label><br>
                            <input class="form-control" value="{{$order['id']}} "
                                   readonly="readonly" type="text" name="id"><br>
                        </div>

                        <div class="border_none">
                            <label for="date_book"><b>Выбранные даты:</b></label><br>

                            <input class="form-control"
                                   value="{{$order['no_in']}} - {{$order['no_out']}}"
                                   readonly="readonly" type="text"
                                   name="date_book">

                            <a onClick="return confirm('Подтвердите действие!')"
                               href='{{route("admin.edit.dates", ['id' => $order->id])}}' type='button'
                               class='btn btn-outline-success btn-sm' style="margin: 5px">Редактировать даты</a>
                        </div>
                        <br>
                        <div class="border_none">
                            <label for="name"><b>ФИО:</b></label><br>
                            <input class="form-control  @error("name") is-invalid @enderror"
                                   readonly="readonly"
                                   value="{{old("name") ?? $order['name']}}" type="text"
                                   name="name"><br>
                        </div>

                        <div class="border_none">
                            <label for="phone"><b>Телефон:</b></label><br>

                            <input class="tel form-control @error("phone") is-invalid @enderror"
                                   readonly="readonly"
                                   value="{{ old('phone') ?? $order['phone']  }}"
                                   type="text" name="phone"><br>
                        </div>

                        <div class="border_none">
                            <label for="email"><b>Email:</b></label><br>
                            <input class="form-control  @error("email") is-invalid @enderror"
                                   value="{{ old('email') ?? $order['email']  }}" type="text"
                                   readonly="readonly"
                                   name="email"><br>
                        </div>

                        <br>
                        <div class="border_none">
                            <label for="total"><b>Сумма:</b></label><br>
                            <input class="form-control  @error("total") is-invalid @enderror"
                                   value="{{ old('total') ?? $order['total']  }}" type="text"
                                   name="total"><br>
                        </div>

                        <div>
                            <input class="btn btn-outline-primary btn-sm" type="submit" value="Редактировать">
                            <br>
                        </div>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push("scripts")
        <script src="{{ asset('js/mask.js') }}" defer></script>
    @endpush
@endsection
