<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <style type="text/css">
            p {
                font-size: 12px;
            }
            th {
                font-size: 14px;
                text-transform: uppercase;
            }
            td {
                font-size: 12px;
            }
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>

    <body>
        <div class="card grey lighten-1 center-align" style="border-radius : 20px">
            <div class="card-body text-black">
                <div class="card-text text-center z-depth-5">
                    <h6>
                        DECLARACION a efectos del articulo 45 bis del Reglamento de Ejecución (UE) 282/2011 del Consejo, de 15 de marzo de 2011,
                        por el que se establecen disposiciones de aplicación de la Directiva 2006/112/CE relativa al sistema común del Impuesto sobre el Valor Añadido.
                    </h6>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body text-black">
                <div class="card-text">
                    <p>La entidad <b>{{ $client->name }}</b> con identificación fiscal intracomunitaria numero <b>{{ $client->vatnumber }}</b>, domiciliada en {{ $client->address }}, {{ $client->zip }} {{ $client->city }}, {{ $client->country }}.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-text center-align grey lighten-4">
                    <h6>MANIFIESTA</h6>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body text-black">
                <div class="card-text">
                    <p>Que ha adquirido a la empresa <b>{{ $seller->name }}</b> con CIF numero <b>{{ $seller->vatnumber }}</b> los siguientes vehículos: </p>
                </div>
            </div>
        </div>
        <table class="centered striped">
            <thead class="grey darken-3 white-text">
                <tr>
                    <th>Modelo</th>
                    <th>Bastidor</th>
                    <th>Matricula</th>
                    <th>Destino</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lines as $line)
                <tr>
                    <td>{{ $line->modele }}</td>
                    <td>{{ $line->vin }}</td>
                    <td>{{ $line->plates }}</td>
                    <td>{{ $line->delivery_place }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card">
            <div class="card-body text-black">
                <div class="card-text">
                    <p>Que la fecha de inicio de la expedición o transporte de los bienes con origen en España con destino a {{ $client->country }} ha sido
                        {{ isset($shippment->shippmentTrucks->date_load) ? $shippment->shippmentTrucks->date_load : '.. / .. / ....' }} .</p>
                    <p>Que la fecha y lugar de llegada de los bienes ha sido el día
                        {{ isset($shippment->shippmentTrucks->date_cmr) ? $shippment->shippmentTrucks->date_cmr : '.. / .. / ....' }}
                         y el lugar {{ $client->country }}.</p>
                    <br>
                    <p>Que los bienes han sido recepcionados en namebre de la empresa destinataria por parte de …………………………… , con documento identificativo numero ................, domiciliado en……………………, y teléfono numero………………….. .</p>
                </div>
            </div>
        </div>
        <br>
        <div class="float-right">
            <p>Firma y Sello</p>
        </div>
        {{-- <div class="row">
            <div class="col s4">
              <div class="card grey lighten-4 text-center" style="height: 150px; border-radius : 10px">
                <div class="card-content center-align">
                  <p>Firma y Sello</p>
                </div>
              </div>
            </div>
        </div> --}}
    </body>
</html>
