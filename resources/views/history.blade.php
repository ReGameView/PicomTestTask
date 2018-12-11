<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>
        Picom | Техническое Задание
    </title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css')  }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body>
    <a href="{{ url('/') }}">Вернутся назад</a>
    <div class="container">
        @include('table', ['history' => $history, 'id' => 'true'])
    </div>
    <?php echo $history->render(); ?>
</body>
</html>




