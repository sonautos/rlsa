<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('trans.proforma') }} {{ $proforma->ref }}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        /* body {
            margin: 0px;
        } */
        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3.5cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
        }
        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
            /** Extra personal styles **/
            background-color: #377b9e;
            color: white;
            text-align: center;
            /* line-height: 1.5cm; */
        }
        .title {
            padding-left: 1cm;
            padding-top: 0.5cm;
            color: #ffffff;
        }
        .refproforma {
            padding-right : 1cm;
            padding-top: 0.5cm;
        }
        .refproforma  h3 {
            text-transform: uppercase;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
        /** Extra personal styles **/
            background-color: #377b9e;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: x-small;
        }
        .page-number:before {
            content: "Page " counter(page);
            padding: 3px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .corps {

        }
        .companies {

        }
        .seller {
            /* margin-left : 40px; */
            bproforma-radius: 3px;
            bproforma: 1px solid #393B36;
            padding: 8px;
            width: 250px;
            height: 100px;
        }
        .seller p {
            font-size: 10px;
        }
        .client {
            text-align : left;
            /* margin-right : 20px; */
            bproforma-radius: 3px;
            bproforma: 1px solid #393B36;
            padding: 8px;
            width: 250px;
            height: 100px;
        }
        .client p {
            font-size: 10px;
        }
        .note {
            text-align : left;
            margin-right : 40px;
            margin-left : 40px;
            bproforma-radius: 3px;
            bproforma: 1px solid #377b9e;
            width: 100%;
            box-align: center;
        }
        .note p {
            font-size: 10px;
            padding: 0px;
        }
        .euros {
            font-size: 8px;
            padding-top: 20px;
        }
        .product-table {
        }
        .product-table thead {
            background: #377b9e;
            color: white;
            font-size: 10px;
        }
        .product-table tbody {
            font-size: 8px;
        }
        .product-table tfoot {

        }
        .total {
            margin: 10px;
        }
        .dataproforma {

        }
        .totaltable {
            width: 40%;
            bproforma-collapse: collapse;
        }
        .totaltable  tr, td {
            bproforma: none;
        }
        .sign {
            padding-top: 20px;
        }
        .sellersign {
            bproforma-radius: 15px;
            bproforma: 1px solid #377b9e;
            margin: auto;
            padding: 8px;
            width: 250px;
            height: 80px;
        }
        .clientsign {
            bproforma-radius: 15px;
            bproforma: 1px solid #377b9e;
            margin: auto;
            padding: 8px;
            width: 250px;
            height: 80px;
        }
        .cg {
            /* bproforma: 1px solid #377b9e; */
            padding-top: 50px;
            margin: auto;
            height: auto;
            max-width: 18cm;
            font-size: 9px;
        }
    </style>

</head>
<body>
    <header>
        <div>
            <table width="100%">
                <td align="left" style="" class="title"><h1>{{ $proforma->entity->name }}</h1></td>
                <td align="right" style="width: 30%">
                    <div class="refproforma">
                        <p>
                            <h3>{{ trans('trans.proforma')}}</h3>
                            <b>{{ trans('trans.Ref') }} : {{ $proforma->ref }}</b><br>
                            {{ trans('trans.date_proforma') }} : {{ $proforma->date_created }}<br>
                            {{ trans('trans.deliveryDate') }} : {{ $proforma->date_livraison }}<br>
                        </p>
                    </div>
                </td>
            </table>
        </div>
    </header>

    <footer>
        <table width="100%">
            <tr>
                <td align="center" style="width: 50%;">
                    {{ $proforma->entity->name }} / {{ $proforma->entity->vatnumber }}
                </td>
            </tr>
            <tr>
                <td align="right">
                    <div class="page-number"></div>
                </td>
            </tr>
        </table>
    </footer>
    <main>

        <div class="corps">
            <div class="companies">
                <table width="100%">
                    <td align="left" style="width: 40%">
                        <div class="seller">
                            <h3>{{ $seller->name }}</h3>
                            <p>
                                {{ $seller->address}} <br>
                                {{ $seller->zip }} - {{ $seller->city }} <br>
                                {{ $seller->country }} {{ isset($seller->state) ? '- '.$seller->state : ''}} <br>
                                {{ trans('trans.VAT') }} : {{ $seller->vatnumber }}
                            </p>
                        </div>
                    </td>
                    <td align="center" style="width: 20%"></td>
                    <td align="right" style="width: 40%">
                        <div class="client">
                            <h3>{{ $client->name }}</h3>
                            <p>
                                {{ $client->address}} <br>
                                {{ $client->zip }} - {{ $client->city }} <br>
                                {{ $client->country }} {{ isset($client->state) ? '- '.$client->state : ''}} <br>
                                {{ trans('trans.VAT') }} : {{ $client->vatnumber }}
                            </p>
                        </div>
                    </td>
                </table>
            </div>
            @if (isset($proforma->public_note))
            <p style="padding-left: 1cm; font-size: 12px; padding-bottom: 0px">{{ trans('trans.Note') }} : <br>
            <div class="note">
                <table width="100%" align="center">
                    <td>
                        {{ $proforma->public_note }}</p>
                    </td>
                </table>
            </div>
            @endif
            <div class="euros" align="right">{{ trans('trans.montant-exprimé-en-euro') }}</div>
            <div class="product-table">
                <table width="100%" align="center">
                    @if ($frevos > 0 )
                    <thead>
                        <tr>
                            <th style="text-align: left; width: 7cm">{{ trans('trans.description') }}</th>
                            <th style="text-align: center; width: 3cm">{{ trans('vehicle.vin') }}</th>
                            <th style="text-align: center; width: 2cm">{{ trans('vehicle.mec') }}</th>
                            <th style="text-align: center; width: 2cm">{{ trans('vehicle.color') }}</th>
                            <th style="text-align: center; width: 2cm">{{ trans('vehicle.frevo') }}</th>
                            <th  style="text-align: center; width: 2cm">{{ trans('trans.price') }}</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach ($proforma->proformaproformaLines as $line)
                        <tr>
                            <td style="text-align: left; bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px" >
                                <b style="font-size: 10px">{{ $line->vehicle->name }}</b> <br>
                                @if ($line->vehicle->plates) {{ trans('trans.plates') }} : {{ $line->vehicle->plates }}@endif
                                @if ($line->vehicle->plates && $line->vehicle->idv) - @endif
                                @if ($line->vehicle->idv) {{ trans('trans.Idv') }} : {{ $line->vehicle->idv }} @endif
                                @if ($line->vehicle->plates || $line->vehicle->plates) <br> @endif
                                {{ trans('vehicle.features') }} : {{ $line->vehicle->feature }}
                            </td>
                            <td style="position: fixed; bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px">{{ $line->vehicle->vin }}</td>
                            <td style="bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px">{{ $line->vehicle->mec }}</td>
                            <td style="bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px">{{ $line->vehicle->color }}</td>
                            <td style="bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px">{{ $line->vehicle->frevo }}</td>
                            <td style="text-align: center; font-size: 11px; bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px"><b>{{ to_money($line->total_ht ) }}</b></td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <thead>
                        <tr>
                            <th style="text-align: left; max-width: 9cm">{{ trans('trans.description') }}</th>
                            <th style="text-align: center; max-width: 3cm">{{ trans('vehicle.vin') }}</th>
                            <th style="text-align: center; max-width: 2cm">{{ trans('vehicle.mec') }}</th>
                            <th style="text-align: center; max-width: 2cm">{{ trans('vehicle.color') }}</th>
                            <th  style="text-align: center; max-width: 2cm">{{ trans('trans.price') }}</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach ($proforma->proformaproformaLines as $line)
                        <tr>
                            <td style="text-align: left; bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px" >
                                <b style="font-size: 10px">{{ $line->vehicle->name }}</b> <br>
                                @if ($line->vehicle->plates) {{ trans('trans.plates') }} : {{ $line->vehicle->plates }}@endif
                                @if ($line->vehicle->plates && $line->vehicle->idv) - @endif
                                @if ($line->vehicle->idv) {{ trans('trans.Idv') }} : {{ $line->vehicle->idv }} @endif
                                @if ($line->vehicle->plates || $line->vehicle->plates) <br> @endif
                                {{ trans('vehicle.features') }} : {{ $line->vehicle->feature }}
                            </td>
                            <td style="position: fixed; bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px">{{ $line->vehicle->vin }}</td>
                            <td style="bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px">{{ $line->vehicle->mec }}</td>
                            <td style="bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px">{{ $line->vehicle->color }}</td>
                            <td style="text-align: center; font-size: 11px; bproforma-bottom-style: dashed; bproforma-bottom-width: 1px; padding-bottom: 5px"><b>{{ to_money($line->total_ht ) }}</b></td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif

                </table>
            </div>
            <div class="total">
                <table width="100%">
                    <td align="left" style="width: 50%" class="dataproforma">
                        <p>
                            {{ trans('trans.method-delivery') }} : {{ $proforma->mode_reglement->name }} <br>
                            {{ trans('trans.method-payment') }} : {{ $proforma->cond_reglement->name }} <br>
                            <table class="bank">
                                <tr>
                                    <td colspan="2">{{ trans('trans.iban') }}</td>
                                    <td colspan="1">{{ trans('trans.swift') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center">1236457386</td>
                                    <td colspan="1" style="text-align: center">qkjdsfh</td>
                                </tr>
                            </table>
                        </p>
                    </td>
                    <td align="right" style="" class="totaltable">
                        <table align="right" style="width: 100%">
                            <tr>
                                <td align="left" style="background: #377b9e; color: white;">{{ trans('trans.total') }}</td>
                                <td align="right" style="background: #377b9e; color: white;">{{ to_money($proforma->total_ht) }} €.</td>
                            </tr>
                            <tr>
                                <td align="left" style="background: #e3f5f8;">{{ trans('trans.tax') }}</td>
                                <td align="right" style="background: #e3f5f8;">{{ isset($proforma->tax) ? $proforma->tax : '0,00' }} €.</td>
                            </tr>
                            <tr>
                                <td align="left" style="background: #377b9e; color: white;">{{ trans('trans.total_ttc') }}</td>
                                <td align="right" style="background: #377b9e; color: white;">{{ isset($proforma->total_ttc) ? to_money($proforma->total_ttc) : to_money($proforma->total_ht) }} €.</td>
                            </tr>
                        </table>
                    </td>
                </table>
            </div>
            <div class="sign">
                <table width="100%">
                    <td align="left" style="width: 45%">
                        <div class="sellersign">
                            {{ trans('trans.date') }} <br>
                            {{ trans('trans.sign') }} :
                        </div>
                    </td>
                    <td align="center" style="width: 20%"></td>
                    <td align="left" style="width: 45%">
                        <div class="clientsign">
                            {{ trans('trans.date') }} <br>
                            {{ trans('trans.sign') }} :
                        </div>
                    </td>
                </table>
            </div>
            <div class="cg" align="center">
                {{ trans('trans.conditions-general')}} :<br>
                Conditions générales qfjdqsl kfjqdsklf jqskdfj qlksd fqsdùf
                sdqofijqsdlmkfjqsd pjsdf k ajj fqk fjlk qddjf aoj flsqdf jùajfqsjù
                sqdlfjhqm oa lfds jfk jaoivmqoj fao ojf oqsjf amjrefqsdmkfnmlqksjdf mlka ha oihf vbqjdfb
                flqlk faoh cqsjkf moahofnqskldnfomahezomdnfkqjsnfmaoehzcjzqbfmhamhfegoma
            </div>
        </div>
    </main>
</body>
