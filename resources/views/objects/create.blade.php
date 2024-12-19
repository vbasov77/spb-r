@extends('layouts.app')
@section('content')
    <link href="{{ asset('css/checkbox/checkbox.css') }}" rel="stylesheet">
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h1 style="margin: 40px 0 60px 0">Добавить объект</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('admin.store.obj')}}" method="post">
                        @csrf
                        <br>
                        <div>
                            <label for="address"><b>Адрес:</b></label>
                            <input name="address" type="text" value="{{old('address') }}"
                                   class="form-control" id="suggest"
                                   placeholder="Адрес" autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="coordinates"><b>Координаты:</b></label>
                            <input name="coordinates" type="text" value="{{old('coordinates') }}"
                                   class="form-control"
                                   placeholder="Координаты" autocomplete="off" required>
                        </div>
                        <br>

                        <div>
                            <label for="rooms"><b>Количество комнат:</b></label><br>
                            <label class="checkbox-btn2">
                                <input type="checkbox" name="count_rooms" id="rooms"
                                       value="студия">
                                <span>Студия</span>
                            </label>
                            <input id="count" name="count_rooms" type="number" value="{{old('count_rooms') }}"
                                   class="form-control"
                                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57 && /^\d{0,2}$/.test(this.value));"
                                   placeholder="Количество комнат" autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="floor"><b>Этаж:</b></label>
                            <input name="floor" type="number" value="{{old('floor') }}"
                                   class="form-control"
                                   placeholder="Этаж" autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="area"><b>Площадь:</b></label>
                            <input name="area" type="number" value="{{old('area') }}"
                                   class="form-control"
                                   placeholder="Общая площадь" autocomplete="off" required>
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-primary" id="submit" type="submit">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/checkbox/checkbox.js') }}" defer></script>
    @endpush
@endsection
