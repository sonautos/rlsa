@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ $ordersList->entity->name ?? '' }}
        <div class="float-right">
            <ul>
                <li>{{ trans('global.author') }} : {{ $ordersList->author->firstname ?? '' }} {{ $ordersList->author->name ?? '' }}</li>
                <li>{{ trans('global.valid-by') }} : {{ $ordersList->valid->firstname ?? '' }} {{ $ordersList->valid->name ?? '' }}</li>
                <li>{{ trans('global.update-by') }} : {{ $ordersList->user_updated->firstname ?? '' }} {{ $ordersList->user_updated->name ?? '' }}</li>
            </ul>
        </div>
    </div>



    @if (session()->has('message-danger'))
<div class="bg-danger tet-white" role="alert">
    <div class="flex">
        <div class="text-center">
            <p class="text-sm">{{ session('message-danger') }}</p>
        </div>
    </div>
</div>
@endif
@if (count($errors) > 0)
<div class = "bg-danger text-black shadow text-center rounded-bottom">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <div class="fade-in">
        <div class="card rounded shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 >{{ trans('trans.seller') }} : <span style="color: #1a9ff1">{{ $ordersList->seller->name }}</span></h3>
                    </div>
                    <div class="text-right col-md-6">
                        <ul>
                            <li>
                                <h5>{{ trans('trans.ref_of_the') }} {{ trans('trans.order') }} : <span style="color: #1a9ff1" >{{$ordersList->ref}}</span>
                                </h5>
                                <p>{{ trans('trans.dateof') }} {{ trans('trans.order') }} : {{ $ordersList->date_created }}<br/>
                                    {{-- {{ trans('cruds.ordersList.fields.date_created') }} : {{ $ordersList->date_created }}<br/>
                                    {{ trans('cruds.ordersList.fields.date_valid') }} : {{ $ordersList->date_valid }}<br/> --}}
                                    {{ trans('cruds.ordersList.fields.cond_reglement') }} : {{ $ordersList->cond_reglement->name }}<br/>
                                    {{ trans('cruds.ordersList.fields.mode_reglement') }} : {{ $ordersList->mode_reglement->name }}<br/>
                                    {{ trans('trans.dateof') }} {{ trans('trans.delivery') }} : {{ $ordersList->date_livraison }}<br/>
                                @if(isset($ordersList->shipping_method->name)){{ trans('trans.delivery_method') }} : {{ $ordersList->shipping_method->name }}@endif</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <div class="card p-2 shadow-lg">
                            <ul>
                                <li><b>{{ $ordersList->client->name }}</b></li>
                                <li>{{ $ordersList->client->address }}</li>
                                <li>{{ $ordersList->client->zip }} {{ $ordersList->client->town }}</li>
                                <li>@if(isset($ordersList->client->state)){{ $ordersList->client->state }} - @endif{{ $ordersList->client->country }}</li>
                                @if (isset($ordersList->delivery_address->name))
                                    <li>{{ trans('cruds.ordersList.fields.delivery_address') }} : {{ $ordersList->delivery_address->name ?? '' }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-2 shadow-lg">
                            <td colspan="3">
                                <table style="width: 100%">
                                    <tr>
                                        <th style="border-top:none">{{ trans('cruds.ordersList.fields.remise') }}</th>
                                        <td style="border-top:none">{{ to_money($ordersList->remise ?? '0') }} €</td>
                                    </tr>
                                    <tr>
                                        <th style="border-top:none">{{ trans('cruds.ordersList.fields.remise_percent') }}</th>
                                        <td style="border-top:none">{{ to_money($ordersList->remise_percent ?? '0') }} %</td>
                                    </tr>
                                    <tr>
                                        <th style="border-top:none">{{trans('trans.total_ht')}}</th>
                                        <td style="border-top:none">{{ to_money($ordersList->total_ht)}} €</td>
                                    </tr>
                                    <tr>
                                        <th style="border-top:none">{{trans('trans.total_ht')}}</th>
                                        <td style="border-top:none">{{ to_money($ordersList->total_tva)}} €</td>
                                    </tr>
                                    <tr>
                                        <th  style="border-top:none">{{trans('trans.total_ttc')}}</th>
                                        <td style="border-top:none">{{ to_money((float)$ordersList->total_ttc)}} €</td>
                                    </tr>
                                    <tr>
                                        <th  style="border-top:none">{{trans('trans.numberOf')}} {{ trans('vehicle.car') }}</th>
                                        <td>{{ count($lines)}}</td>
                                    </tr>
                                    <tr>
                                        <th  style="border-top:none">{{trans('trans.totalComm')}}</th>
                                        <td>{{ to_money($comsellers+$comclients) }} € H.T</td>
                                    </tr>
                                </table>
                            </td>
                        </div>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="card" aria-label="Close"></button>
            </div>

            <div class="card-body">
                <div class="card shadow">
                    <div class="text-right">
                        @include('admin.ordersLists.includes.update-line')
                        <button class="text-dark hover:bg-indigo-200 hover:text-black rounded" onclick="$('#Modal').modal('show')" href=""><i class="fas fa-edit"></i></button>
                    </div>
                    <div class="m-3">
                        <div class="table-responsive">
                            <table class=" table table-hover datatable datatable-orderOrderLines">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            {{ trans('global.designation') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.vin') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.plates') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.color') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.mec') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.frevo') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.orderLine.fields.total_ht') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.orderLine.fields.total_tva') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.orderLine.fields.total_ttc') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.orderLine.fields.comclient') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ordersList->orderOrderLines as $key => $orderLine)
                                        <tr data-entry-id="{{ $orderLine->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $orderLine->product->name ?? '' }}
                                                {{ $orderLine->service->name ?? '' }}
                                                {{ $orderLine->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $orderLine->vehicle->vin ?? '' }}
                                            </td>
                                            <td>
                                                {{ $orderLine->vehicle->plates ?? '' }}
                                            </td>
                                            <td>
                                                {{ $orderLine->vehicle->color ?? '' }}
                                            </td>
                                            <td>
                                                {{ $orderLine->vehicle->mec ?? '' }}
                                            </td>
                                            <td>
                                                {{ to_money($orderLine->vehicle->frevo ?? '0') }}
                                            </td>
                                            <td>
                                                {{ $orderLine->total_ht ?? '' }}
                                            </td>
                                            <td>
                                                {{ $orderLine->total_tva ?? '' }}
                                            </td>
                                            <td>
                                                {{ $orderLine->total_ttc ?? '' }}
                                            </td>
                                            <td>
                                                {{ $orderLine->comclient ?? '' }}
                                            </td>
                                            <td>
                                                @can('order_line_show')
                                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.order-lines.show', $orderLine->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('order_line_edit')
                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.order-lines.edit', $orderLine->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('order_line_delete')
                                                    <form action="{{ route('admin.order-lines.destroy', $orderLine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @can('order_line_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success float-right mx-5" href="{{ route('admin.order-lines.create') }}">+</a>
                        </div>
                    </div>
                    @endcan
                    {{-- <table class="table table-sm responsive-table">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="4" class="text-center bg-dark white">{{trans('trans.description')}}</th>
                                <th colspan="5" class="text-center bg-dark white border-left">{{trans('trans.price')}}</th>
                                <th colspan="2" class="text-center bg-dark white border-left">{{trans('trans.commission')}}</th>
                            </tr>
                            <tr>
                                <th class="text-center">{{trans('trans.description')}}</th>
                                <th class="text-center">{{trans('vehicle.vin')}}</th>
                                <th class="text-center">{{trans('vehicle.plates')}}</th>
                                <th class="text-center">{{trans('vehicle.color')}}</th>
                                <th class="text-center">{{trans('vehicle.tva_tax')}}</th>
                                <th class="text-center">{{trans('trans.total_tax')}}</th>
                                <th class="text-center">{{trans('trans.subprice')}}</th>
                                <th class="text-center">{{trans('trans.subprice')}}</th>
                                <th class="text-center">{{trans('trans.remise')}}</th>
                                <th class="text-right">{{trans('trans.seller')}}</th>
                                <th class="text-right">{{trans('trans.Client')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($lines))
                                @foreach($lines as $line)
                                    @if ($line->product_type == 0)
                                    <tr>
                                        @if (isset($line->product->name))
                                            <td><b>{{ $line->product->name }}</td>
                                        @endif
                                        @if (isset($line->product->ref))
                                            <td class="text-center">{{ $line->product->ref }}</td>
                                        @endif
                                        @if (isset($line->extra->plates))
                                            <td class="text-center">{{ $line->extra->plates }}</td>
                                        @endif
                                        @if (isset($line->extra->color))
                                            <td class="text-center">{{ $line->extra->color }}</td>
                                        @endif
                                        <td class="text-center border-left">{{ to_money((float)$line->tva_tx)}}</td>
                                        <td class="text-center">{{ to_money((float)$line->total_tva)}}</td>
                                        <td class="text-center">{{ to_money((float)$line->subprice)}}</td>
                                        <td class="text-center">{{ (float)$line->subprice - (float)$line->total_ht }}</td>
                                        <td class="text-center">{{ to_money((float)$line->total_ht)}}</td>
                                        <td class="text-right border-left border-bottom">{{ isset($line->extra->comseller) ? to_number($line->extra->comseller) : 0 }} €</td>
                                        <td class="text-right border-bottom">{{ isset($line->extraline->comclient) ? to_number($line->extraline->comclient) : 0 }} €</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td><b>{{ $line->name }}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ to_money((float)$line->total_tva)}}</td>
                                        <td>{{ to_money((float)$line->total_ht)}}</td>
                                        @if (isset($line->extra->plates))
                                            <td>{{ to_number($line->extra->comseller) }} €</td>
                                        @endif
                                    </tr>
                                    @endif
                                @endforeach
                            @else
                            <td colspan="4">{{trans('trans.no lines were made')}}</td>
                            @endif

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="1">
                                <table style="width: 100%">
                                    <tr>
                                        <td style=" border: none; ">{{$ordersList->note_public }}</td>
                                     </tr>
                                </table>
                             </td>
                            <td colspan="8">
                                <table style="width: 100%">
                                    <tr>
                                        <th style="border-top:none">{{trans('trans.total_ht')}}</th>
                                        <td style="border-top:none">{{ to_money((float)$ordersList->total_ht)}}</td>
                                    </tr>
                                    <tr>
                                        <th >{{trans('trans.total_ttc')}}</th>
                                        <td>{{ to_money((float)$ordersList->total_ttc)}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        </tfoot>
                    </table> --}}
                </div>
                <div class="btn-group d-block" role="group" aria-label="Basic example">
                    <form action="{{ route('admin.order.pdf') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="" value="{{ $ordersList->id }}">
                        <button class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-2 rounded" type="submit">
                            {{trans('trans.print')}}
                        </button>
                    </form>
                    <a class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-2 rounded m-2" href="{{ route('admin.order.com-order', $ordersList ) }}" type="button">
                        {{trans('dolibarr.create-com-order')}}
                    </a>
                    @if (!empty($ordersList->ref_order_client))
                        <a class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-2 rounded m-2" href="{{ route('admin.order.getComOrder', $ordersList->ref_order_client ) }}" type="button">
                            {{trans('dolibarr.get-doli-order-client')}}
                        </a>
                    @endif
                    @if (!empty($ordersList->ref_order_seller))
                        <a class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-2 rounded m-2" href="{{ route('admin.order.getComOrder', $ordersList->ref_order_seller ) }}" type="button">
                            {{trans('dolibarr.get-doli-order-seller')}}
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group d-block text-right" role="group" aria-label="Basic example">
                    <a type="button" class="btn btn-outline-dark" href='{{ route('admin.orders-lists.index') }}'>{{trans('trans.back')}}</a>
                    <a type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" href="#">{{ trans('trans.delete') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.note_private') }}
                        </th>
                        <td>
                            {{ $ordersList->note_private }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.note_public') }}
                        </th>
                        <td>
                            {{ $ordersList->note_public }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.signed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $ordersList->signed ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#order_shipp_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.shippLine.title') }}
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="#order_order_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.orderLine.title') }}
            </a>
        </li> --}}
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="order_shipp_lines">
            @includeIf('admin.ordersLists.relationships.orderShippLines', ['shippLines' => $ordersList->orderShippLines])
        </div>
        {{-- <div class="tab-pane" role="tabpanel" id="order_order_lines">
            @includeIf('admin.ordersLists.relationships.orderOrderLines', ['orderLines' => $ordersList->orderOrderLines])
        </div> --}}
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
    $(function () {
        // let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        // @can('order_line_delete')
        // let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        // let deleteButton = {
        //     text: deleteButtonTrans,
        //     url: "{{ route('admin.order-lines.massDestroy') }}",
        //     className: 'btn-danger',
        //     action: function (e, dt, node, config) {
        //     var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
        //         return $(entry).data('entry-id')
        //     });

        //     if (ids.length === 0) {
        //         alert('{{ trans('global.datatables.zero_selected') }}')

        //         return
        //     }

        //     if (confirm('{{ trans('global.areYouSure') }}')) {
        //         $.ajax({
        //         headers: {'x-csrf-token': _token},
        //         method: 'POST',
        //         url: config.url,
        //         data: { ids: ids, _method: 'DELETE' }})
        //         .done(function () { location.reload() })
        //     }
        //     }
        // }
        // dtButtons.push(deleteButton)
        // @endcan

        // $.extend(true, $.fn.dataTable.defaults, {
        //     orderCellsTop: true,
        //     order: [[ 2, 'desc' ]],
        //     pageLength: 100,
        // });
        // let table = $('.datatable-orderOrderLines:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        //     $($.fn.dataTable.tables(true)).DataTable()
        //         .columns.adjust();
        // });
    })

</script>
@endsection
