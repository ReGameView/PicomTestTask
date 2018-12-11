@if($history->count() == 0)
    <h2>Записей нет</h2>
@endif
<?php
if(empty($id)) {
    $id = false;
}
?>
<table<?= $history->count() == 0 ? " style='display: none'" : "" ?>>
    <tr>
        <th>#</th>
        <th>Search</th>
        <th>Result</th>
        <th>Request Time</th>
    </tr>
    @foreach($history as $item)
        <tr>
            <td>{{ $id ? $item['id'] : $loop->iteration }}</td>
            <td>{{ $item['search'] }}</td>
            <td>{!! $item['result'] !!}</td>
            <td>{{ $item['created_at'] }}</td>
        </tr>
    @endforeach
</table>
