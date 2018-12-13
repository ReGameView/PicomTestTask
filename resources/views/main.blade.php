@extends('helper.design')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <form id="searchForm" method="POST">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Pls write text" aria-describedby="button-addon2" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="result alert" role="alert"></div>
        @include('helper.table', ['history' => $history, 'title' => 'Последние 10 запросов'])
        @if($history->count() >= 10)
            <a href="{{ url('/history') }}">Посмотреть всю историю</a>
        @endif
    </div>
</div>
<script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
@endsection
