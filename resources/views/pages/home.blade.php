@extends('layouts.default')
@section('content')
    <div class="container">
        <h1 class="mb-2 text-left">Проверка ИНН</h1>

        @if(session('message'))
            <div class='alert alert-success'>
                {{ session('message') }}
            </div>
        @endif

        <div class="col-12 col-md-6">
            <form class="form-horizontal" method="POST" action="/inn">
{{--                @method('patch')--}}
                @csrf
                <div class="form-group">
                    <label for="inn">ИНН: </label>
                    <input type="text" class="form-control" id="inn" placeholder="Ваш ИНН" name="inn" required>
                    @error('inn')
                        <div>{{ $message }}</div>
                    @enderror
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="Send">Отправить</button>
                </div>
            </form>
        </div>
    </div> <!-- /container -->
@stop
