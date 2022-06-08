<!-- <!DOCTYPE html> -->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>{{ trans('vehicle.name') }} {{ $car->name }}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        /* body {
            margin: 0px;
        } */
        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 20mm;
        }
        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 1cm;
            right: 1cm;
            height: 20mm;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            padding-top: 5px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        img {
            width: 30%;
        }
        .spec {
            font-size: 16px;
        }
        .price {
            text-align: center;
            border-radius: 20px;
            font-size: 20px;
            background-color: green;
            border: 1px solid green;
            padding: 8px;
            width: 40%;
            height: auto;
            color: white;
            float:left;
            margin-right: 20px;
            margin-bottom: 8px;
            /* margin-bottom: 8px; */
        }
        .options {
            padding: 8px;
            width: 100%;
            height: auto;
            font-size: 16px;
            margin-bottom: 8px;
        }
        .serie {
            padding: 8px;
            width: 100%;
            height: auto;
            font-size: 14px;
        }
    </style>

</head>
<body>
    <footer>
        <table width="100%">
            <tr>
                <td align="center">
                    <hr>
                    {{ $car->entity->name }} - {{ $car->entity->siren }}<br>
                    {{ $car->entity->vatnumber }}
                </td>
                <td>
                    <div class="page-number"></div>
                </td>
            </tr>
        </table>
    </footer>
    <div style="page-break-after:auto;"></div>
    <main>
        <div>
            <table width="100%">
                <td align="left" width="40%"><img src="{{ asset('img/logo.png') }}" alt="RLSA"></td>
                <td align="right" width="20%"></td>
                <td align="right" width="40%">
                    <p style="font-size: 16px">
                        {{ trans('trans.Ref')}} : {{ $car->id }}<br>
                        {{ trans('vehicle.vin')}} : {{ $car->vin }}<br>
                    </p>
                </td>
            </table>
        </div>
        <div class="photo pt-5 text-center">
            @foreach($car->version->image as $key => $media)
                <img src="{{$media->getUrl()}}">
            @endforeach
        </div>
        <div style="text-transform: uppercase" class="text-center pb-3">
            <b style="font-size: 28px">{{ $car->name }}</b>
        </div>

        <div class="options text-center">
            <b class="text-center">{{trans('trans.options')}} : </b><br>
            {{ $car->feature }}
        </div>

        <div align="center" widht="100%" class="spec">
            <div class="table">
                <table class="table table-sm" width="90%">
                    <tr>
                        <td>{{trans('vehicle.make')}}</td>
                        <td>{{ $car->make }}</td>
                        <td>{{ trans('vehicle.color')}}</td>
                        <td>{{ $car->color }}</td>
                    </tr>
                    <tr>
                        <td>{{trans('vehicle.modele')}}</td>
                        <td>{{ $car->modele }}</td>
                        <td>{{trans('vehicle.mec')}}</td>
                        <td>{{ $car->mec ?? 'en cours' }}</td>
                    </tr>
                    <tr>
                        <td>{{trans('vehicle.version')}}</td>
                        <td>{{ $car->version->description }}</td>
                        <td>{{trans('vehicle.cv')}}</td>
                        <td>{{ $car->ch }} cv</td>
                    </tr>
                    <tr>
                        <td>{{trans('vehicle.motor')}}</td>
                        <td>{{ $car->version->motor }}</td>
                        <td>{{trans('vehicle.co2')}}</td>
                        <td>{{ $car->co_2 }} g/km</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="price">
            <p>{{ trans('trans.priceNew')}} : {{ to_money($car->price_new) }} € TTC</p>
            <p style="color: yellow">{{ trans('trans.priceToSell' )}} : <b style="font-size: 24px;">{{ to_money($car->price_ht) }}</b> € HT</p>
            <p>{{ trans('trans.discount' )}} : {{ to_money(price_HT_fr($car->price_new)-$car->price_ht) }} € HT</p>
            <p>{{ trans('trans.discountPercent' )}} : {{ percent(price_HT_fr($car->price_new)-$car->price_ht, price_HT_fr($car->price_new)) }} %</p>
        </div>
        
        <div class="serie">
            <b class="text-center" style="text-transform: capitalize">{{trans('vehicle.equipments')}} : </b><br>
            {{ $car->serie }}
        </div>

    </main>
</body>