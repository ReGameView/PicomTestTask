<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>
        Picom | Техническое Задание
    </title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css')  }}">
</head>
<body>
    <form id="searchForm" method="POST">
        {{ csrf_field() }}
        <input type="text" name="search" placeholder="Pls write text" required>
        <button type="submit">Search!</button>
    </form>

    <div class="result">

    </div>

    <h2>Последние 10 запросов</h2>
    @include('table', ['history' => $history])
    @if($history->count() >= 10)
        <a href="{{ url('/history') }}">Посмотреть всю историю</a>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
</body>
</html>
