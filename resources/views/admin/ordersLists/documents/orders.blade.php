<!-- <!DOCTYPE html> -->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>{{ trans('order.order') }} {{ $order->ref }}</title>

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
        .page-number:before {
            content: "Page " counter(page);
            padding: 3px;
            left: 1cm;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        tfoot tr td {
            font-size: 14px;
            border: border: none;
        }
        .seller {
            /* margin-left : 40px; */
            border-radius: 5px;
            border: 1px solid #ECECEC;
            padding: 8px;
            width: 90%;
            height: 150px;
            font-size: 16px;
            background-color: #ECECEC;
        }
        /* .seller p {
            font-size: 10px;
        } */
        .client {
            text-align : left;
            /* margin-right : 20px; */
            border-radius: 3px;
            border: 1px solid #393B36;
            padding: 8px;
            width: 90%;
            height: 150px;
            float: right;
            font-size: 16px;
        }

        .note {
            text-align : left;
            /* margin-right : 40px;
            margin-left : 40px; */
            border-radius: 3px;
            border: 1px solid #393B36;
            width: 100%;
            box-align: center;
            margin: 2px;
        }
        .euros {
            font-size: 12px;
            padding-top: 20px;
        }
        .product-table {
        }
        .product-table thead {
            background: #393B36;
            color: white;
            font-size: 14px;
            border: none;
        }
        .product-table tbody {
            /* font-size: px; */
        }
        .product-table tfoot {

        }
        .total {
            font-size: 14px;
        }
        .dataorder {

        }
        .totaltable {
            width: 40%;
            border-collapse: collapse;
            font-size: 14px;
            text-transform: uppercase;
        }
        .totaltable  tr, td {
            border: none;
        }
        .sign {
            padding-top: 20px;
        }
        .sellersign {
            /* border-radius: 10px;
            border: 1px solid #393B36; */
            padding: 8px;
            width: 350px;
            height: 80px;
            font-size: 15px;
        }
        .clientsign {
            /* border-radius: 10px;
            border: 1px solid #393B36; */
            padding: 8px;
            width: 350px;
            height: 80px;
            float: right;
            font-size: 15px;
        }
        .cg {
            /* border: 1px solid #377b9e; */
            margin: auto;
            height: auto;
            max-width: 19cm;
            font-size: 10px;
        }
    </style>

</head>
<body>
    <footer>
        <table width="100%">
            <tr>
                <td align="center">
                    <hr>
                    {{ $order->entity->name }} - {{ $order->entity->siren }}<br>
                    {{ $order->entity->vatnumber }}
                </td>
                <td align="right">
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
                <td align="center" width="20%"></td>
                <td align="right" width="40%">
                    <p style="font-size: 16px">
                        {{ trans('order.Ref')}} : {{ $order->ref }}<br>
                        {{ trans('order.date-order')}} : {{ $order->date_created }}<br>
                        {{ trans('order.date-delivery')}} : {{ $order->date_livraison }}<br>
                    </p>
                </td>
            </table>
        </div>
        <div style="text-transform: uppercase" class="text-center">
            <b>{{ trans('order.order') }}</b>
        </div>
        <div class="corps">
            <div class="companies pt-3 pb-1">
                <table width="100%">
                    <td align="left" style="width: 50%">
                        <b style="text-transform: capitalize; font-size: 14px">{{trans('trans.seller')}}</b>
                        <div class="seller">
                            <p>
                                <b>{{ $seller->name }}</b><br>
                                {{ $seller->address}} <br>
                                {{ $seller->address_2 ?? '' }}
                                {{ $seller->zip }} - {{ $seller->city }} <br>
                                {{ $seller->country }} {{ isset($seller->state) ? '- '.$seller->state : ''}} <br>
                                {{ trans('order.VAT') }} : {{ $seller->vatnumber }}
                            </p>
                        </div>
                    </td>
                    <td align="right" style="width: 50%" >
                        <b  align="right" style="text-transform: capitalize; font-size: 14px">{{trans('trans.client')}}</b>
                        <div class="client">
                            <p>
                                <b>{{ $client->name }}</b><br>
                                {{ $client->address}} <br>
                                {{ $client->zip }} - {{ $client->city }} <br>
                                {{ $client->country }} {{ isset($client->state) ? '- '.$client->state : ''}} <br>
                                {{ trans('order.VAT') }} : {{ $client->vatnumber }}
                            </p>
                        </div>
                    </td>
                </table>
            </div>
            @if (isset($order->note_public))
            <b style="margin-left: 2cm; font-size: 13px;">{{ trans('order.Note') }} : </b>
            <div class="note">
                <table width="100%" align="center">
                    <td style="font-size: 13px;">
                        <p>{{ $order->note_public }}</p>
                    </td>
                </table>
            </div>
            @endif
            <div class="euros" align="right">{{ trans('order.montant-exprimé-en-euro') }}</div>
            <div class="product-table">
                <table class="table table-sm" width="90%" style="font-size: 12px;">
                    <thead class="shadow-xl">
                        <tr>
                            <th style="text-align: left; width:100mm;">{{ trans('order.description') }}</th>
                            <th style="text-align: center;">{{ trans('order.vin') }}</th>
                            <th style="text-align: center;">{{ trans('order.mec') }}</th>
                            <th style="text-align: center;">{{ trans('order.color') }}</th>
                            <th  style="text-align: center; width:20mm;">{{ trans('order.price') }}</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach ($order->orderOrderLines as $line)
                        <tr>
                            <td style="text-align: left; border-bottom-style: dashed; border-bottom-width: 1px; padding-bottom: 2px" >
                                <b style="font-size: 14px">{{ $line->vehicle->name }}</b> <br>
                                @if ($line->vehicle->plates) {{ trans('order.plates') }} : {{ $line->vehicle->plates }}@endif
                                @if ($line->vehicle->idv) - {{ trans('order.idv') }} : {{ $line->vehicle->idv }} @endif
                                @if ($line->vehicle->kms) {{ trans('Kms') }} : - {{ $line->vehicle->kms }} kms @endif
                                @if ($line->vehicle->frevo) - {{ trans('order.frevo')}} : {{ $line->vehicle->frevo }} @endif <br>
                                @if ($line->vehicle->feature) {{ trans('order.features') }} : {{ $line->vehicle->feature }} <br> @endif
                                @if ($line->vehicle->private_note) OBS : {{ $line->vehicle->private_note }} @endif
                            </td>
                            <td style="position: fixed; border-bottom-style: dashed; border-bottom-width: 1px; padding-bottom: 2px">{{ $line->vehicle->vin }}</td>
                            <td style="border-bottom-style: dashed; border-bottom-width: 1px; padding-bottom: 2px">{{ $line->vehicle->mec }}</td>
                            <td style="border-bottom-style: dashed; border-bottom-width: 1px; padding-bottom: 2px">{{ $line->vehicle->color }}</td>
                            <td style="text-align: center; font-size: 14px; border-bottom-style: dashed; border-bottom-width: 1px; padding-bottom: 2px"><b>{{ to_money($line->total_ht ) }}</b></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="1">
                                <p>
                                    {{ trans('order.method-payment') }} : <b align="right">{{ trans('order.'.$order->cond_reglement->name) }}</b><br>
                                    {{ trans('order.method-delivery') }} : <b align="right">{{ trans('order.'.$order->mode_reglement->name) }}</b><br>
                                    {{-- {{ trans('order.iban') }} : <b>1236457386</b> - {{ trans('order.swift') }} : <b>qkjdsfh</b> --}}
                                </p>
                            </td>
                            <td align="left" style="font-size: 16px; text-align: right">
                                <p>
                                    {{ trans('order.total') }}<br>
                                    {{ trans('order.tax') }}<br>
                                    {{ trans('order.total_ttc') }}<br>
                                </p>
                            </td>
                            <td align="right" colspan="3" style="font-size: 16px; padding-right: 5mm">
                                <p>
                                    <b>{{ to_money($order->total_ht) }} €</b><br>
                                    <b>{{ isset($order->tax) ? $order->tax : '0,00' }} €</b><br>
                                    <b>{{ isset($order->total_ttc) ? to_money($order->total_ttc): to_money($order->total_ht)}} €</b><br>
                                </p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div style="page-break-inside:avoid;">
                <div class="cg" align="center">
                    <b>{{ trans('order.conditions-general')}} :</b>{{trans('order.cg')}}
                </div>
                <div class="sign">
                    <table width="100%">
                        <td align="left" style="width: 50%">
                            <div class="sellersign">
                                {{ trans('order.date') }} <br>
                                {{ trans('order.sign') }}  {{trans('trans.seller')}} :
                            </div>
                        </td>
                        <td align="left" style="width: 50%">
                            <div class="clientsign">
                                {{ trans('order.date') }} <br>
                                {{ trans('order.sign') }} {{trans('trans.Client')}} :
                            </div>
                        </td>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
