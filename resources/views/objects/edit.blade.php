@extends('layouts.app')
@section('content')
    <link href="{{ asset('css/checkbox/checkbox.css') }}" rel="stylesheet">
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h1 style="margin: 40px 0 60px 0">Редактировать объект</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="form" action="{{route('admin.update.obj')}}">
                        @csrf
                        <br>
                        <div>
                            <h5>Адрес:</h5>
                            <input name="address" type="text" value="{{$obj->address ?? old('address') }}"
                                   class="form-control"
                                   placeholder="Адрес" autocomplete="off">
                        </div>
                        <br>
                        <div>
                            <h5>Координаты:</h5>
                            <input name="coordinates" type="text" value="{{$obj->coordinates ?? old('coordinates') }}"
                                   class="form-control"
                                   placeholder="Координаты" autocomplete="off">
                        </div>
                        <br>
                        <div>
                            <h5>Общая площадь:</h5>
                            <input id="area" name="area" type="text" value="{{$obj->area ?? old('area') }}"
                                   onkeyup="return checkСommas(this);"
                                   class="form-control"
                                   placeholder="Общая площадь" autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <h5>Этаж:</h5>
                            <input name="floor" type="number" value="{{$obj->floor ?? old('floor') }}"
                                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57 && /^\d{0,3}$/.test(this.value));"
                                   class="form-control"
                                   placeholder="Этаж" autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <h5>Количество комнат</h5>
                            <label class="checkbox-btn2">
                                <input type="checkbox" name="count_rooms" id="rooms"
                                       value="студия"
                                        @php
                                            if ($obj->count_rooms === "студия") {
                                                echo 'checked';

                                            }@endphp>
                                <span>Студия</span>
                            </label>

                            <input id="count" name="count_rooms" type="number"
                                   value="{{$obj->count_rooms ?? old('count_rooms') }}"
                                   class="form-control"
                                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57 && /^\d{0,2}$/.test(this.value));"
                                   placeholder="Количество комнат" autocomplete="off" required>
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-primary submit" id="submit" type="submit">Сохранить</button>
{{--                        <a href='{{route('object.view', ['id' => $obj->id])}}' type='button'--}}
{{--                           class='btn btn-success' style="margin: 5px">Просмотр</a>--}}
                    </form>

                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            var id = @json($obj->id);
            var countRoom = @json($obj->count_rooms);
        </script>
        <script>
            if (countRoom === "студия") {
                document.getElementById('count').disabled = true;
            }
        </script>
        <script src="{{ asset('js/checkbox/checkbox.js') }}" defer></script>
        <script src="{{ asset('js/checkСommas/checkСommas.js') }}" defer></script>
    @endpush
@endsection
