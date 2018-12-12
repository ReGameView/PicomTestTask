@if($history->count() == 0)
    <h2>Записей нет</h2>
@endif
<?php
if(empty($id)) {
    $id = false;
}
if(empty($title)) {
    $title = "";
}
?>
<table style='<?= $history->count() == 0 ? "display: none' " : "" ?>max-width: 1000px' class="table">
    <caption>
        {{ $title }}
    </caption>
    <thead>
        <tr>
            <th scope="col" width="1%">#</th>
            <th scope="col">Search</th>
            <th scope="col" width="25%">Result</th>
            <th scope="col" width="14%">Request Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($history as $item)
            <tr>
                <td scope="row">{{ $id ? $item->id : $loop->iteration }}</td>
                <td>{{ $item->search }}</td>
                <td>
                    @foreach($item->country as $country)
                        <img src="{{ asset('img/country/'. $country->short_name .'.png') }}">
                        {{ $country->name }}<br/>
                    @endforeach
                </td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </tbody>

</table>
