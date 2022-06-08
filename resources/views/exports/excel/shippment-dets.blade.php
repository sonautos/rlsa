<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
            table, td {border:2px solid black}
            table {border-collapse:collapse}
        </style>

    </head>

    <body>
<div class="card">
    <div class="card-title">
        <h5>FROM : {{ $shipp->entity->name}}</h5>
        <h5>Shippment Ref. {{ $shipp->ref }}</h5>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">Date order : {{ to_date(now()) }}</li>
        </ul>
    </div>
</div>
<br>

<table class="table centered">
    <thead>
        <tr style="backgroud-color: black;">
            <th style="width: 22px; backgroud-color: #000000;">MODEL</th>
            <th style="width: 22px;">VIN</th>
            <th style="width: 20px;">COLOR</th>
            <th style="width: 12px;">PLATES</th>
            <th style="width: 12px;">COMPANY</th>
            <th style="width: 50px;">LOADING PLACE</th>
            <th style="width: 12px;">COMPANY</th>
            <th style="width: 50px;">DELIVERY PLACE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($shipp->shippmentShippLines as $line)
        <tr>
            <td>{{ $line->modele }}</td>
            <td>{{ $line->vin }}</td>
            <td>{{ $line->color }}</td>
            <td>{{ $line->plates }}</td>
            <td>{{ $line->seller->name }}</td>
            <td>{{ $line->loading_place }}</td>
            <td>{{ $line->client->name }}</td>
            <td>{{ $line->delivery_place }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
