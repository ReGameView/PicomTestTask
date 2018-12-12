@extends('helper.design')
@section('content')
    <a href="{{ url('/') }}">Вернутся назад</a>
    <div class="container">
        @include('helper.table', ['history' => $history, 'id' => 'true'])
    </div>
    <?php echo $history->render(); ?>
@endsection