@extends('layouts.create_material')
@section('content')
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <br>
                    @if (!empty($message))
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                    @endif
                    <h1 style="margin: 40px 0 60px 0">Добавить материал</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('admin.store.material')}}" method="post">
                        @csrf
                        <input type="hidden" name="obj_id" value="1">
                        <br>
                        <div>
                            <label for="value"><b>Название:</b></label>
                            <input id="value" name="title" type="text" value="{{old('title')}}"
                                   class="form-control"
                                   placeholder="Название" autocomplete="off" required>
                        </div>
                        <div id="dropdown">
                            <select style="background-color: gainsboro; margin-top: 5px;" class="select" name="list" id="list"></select>
                        </div>
                        <br>
                        <div>
                            <label for="description"><b>Описание:</b></label>
                            <input name="description" type="text" value="{{old('description') }}"
                                   class="form-control"
                                   placeholder="Описание" autocomplete="off">
                        </div>
                        <br>
                        <div>
                            <label for="price"><b>Цена:</b></label>
                            <input name="price" type="number" value="{{old('price') }}"
                                   class="form-control"
                                   placeholder="Цена" autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="quantity"><b>Количество:</b></label>
                            <input name="quantity" type="number" value="{{old('quantity') }}"
                                   class="form-control"
                                   placeholder="Количество" autocomplete="off" required>
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-success" id="submit" type="submit">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/autocomplite/autocomplite.js') }}" defer></script>
    @endpush
@endsection
