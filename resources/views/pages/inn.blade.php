@extends('layouts.default')
@section('content')
    <div class="container">
        <h1 class="mb-2 text-left">Результаты ИНН</h1>

        <div>
            ИНН: {{ $viewModel->getInn() }}
        </div>

        @if ($viewModel->getSelfEmployedStatus())
            <div>
                Статус: {{ $viewModel->getSelfEmployedStatus() }}
            </div>
        @endif


    </div> <!-- /container -->
@stop
