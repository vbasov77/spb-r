@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <br>
                @if(!empty($error))
                    <x-alert type="danger" :message="$error"/>
                @endif
                @if($errors->any())
                    @foreach($errors -> all() as $error)
                        <x-alert type="danger" :message="$error"/>
                    @endforeach
                @endif
                <div style="margin-top: 50px" class="card">
                    <div class="card-header">Введите пароль</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('check.reports_index') }}">
                            @csrf

                            <input id="password" type="password" class="form-control @error('password')
                                    is-invalid @enderror" name="password"
                                   required autocomplete="password" autofocus>
                            <br>
                            <button type="submit" class="btn btn-outline-success btn-sm">
                                Войти
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
