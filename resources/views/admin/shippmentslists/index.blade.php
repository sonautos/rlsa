@extends('layouts.admin')
@section('content')
@can('shippmentslist_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.shippmentslists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.shippmentslist.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Shippmentslist', 'route' => 'admin.shippmentslists.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.shippmentslist.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table display table-hover ajaxTable datatable datatable-Shippmentslist">
            <thead>
                <tr>
                    <td></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($entities as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($shipp_statuses as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            <option value="0">{{ trans('trans.no-paid') }}</option>
                            <option value="1">{{ trans('trans.paid') }}</option>
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->firstname }}">{{ $item->firstname }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($sellers as $key => $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($clients as $key => $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="sum"></td>
                    <td class="sum"></td>
                    <td class="sum"></td>
                    <td></td>
                </tr>
                <tr>
                    <th width="10"></th>
                    <th>{{ trans('cruds.shippmentslist.fields.ref') }}</th>
                    <th>{{ trans('cruds.shippmentslist.fields.entity') }}</th>
                    <th>{{ trans('cruds.shippmentslist.fields.status') }}</th>
                    <th>{{ trans('trans.paid') }}</th>
                    <th>{{ trans('cruds.user.fields.name') }}</th>
                    <th>{{ trans('trans.seller') }}</th>
                    <th>{{ trans('trans.client') }}</th>
                    <th>{{ trans('cruds.shippmentslist.fields.date_delivery') }}</th>
                    <th>{{ trans('trans.date_load') }}</th>
                    <th>{{ trans('trans.date_cmr') }}</th>
                    <th>{{ trans('trans.price-truck') }}</th>
                    <th>{{ trans('trans.price-truck-sold') }}</th>
                    <th>{{ trans('trans.margin') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('shippmentslist_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.shippmentslists.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
            var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
            });

            if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
            }

            if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
            }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        let hidden_row = [2,5,8];

    let dtOverrideGlobals = {
        buttons: dtButtons,
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: "{{ route('admin.shippmentslists.index') }}",
        columnDefs: [
            {
                targets: hidden_row,
                visible: false,
            }
        ],
        columns: [
            { data: 'placeholder', name: 'placeholder' },
            { data: 'ref', name: 'ref' },
            { data: 'entity_name', name: 'entity.name' },
            { data: 'status_name', name: 'status.name' },
            { data: 'paid_status', name: 'shippmentTrucks.paid' },
            { data: 'user_firstname', name: 'user.firstname' },
            { data: 'seller_name', name: 'shippmentShippLines.seller_id' },
            { data: 'client_name', name: 'shippmentShippLines.client_id' },
            { data: 'date_delivery', name: 'date_delivery' },
            { data: 'date_load', name: 'date_load' },
            { data: 'date_cmr', name: 'date_cmr' },
            { data: 'price_truck', name: 'truck.price',  orderable:false, searchable: false },
            { data: 'price_sold', name: 'shippmentShippLines.price',  orderable:false, searchable: false },
            { data: 'margin', name: 'margin', searchable: false },
            { data: 'actions', name: '{{ trans('global.actions') }}', orderable:false, searchable: false }
        ],
        orderCellsTop: true,
        order: [[ 1, 'desc' ]],
        pageLength: 100,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total_truck = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal_truck = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            // Total over all pages
            total_sold = api
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal_sold = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            // Total over all pages
            total_margin = api
                .column( 13 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal_margin = api
                .column( 13, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
 
            // Update footer
            $( api.column( 11 ).header('.sum') ).html(
                '$'+pageTotal_truck +' ( $'+ total_truck +' total)'
            );
            $( api.column( 12 ).header('.sum') ).html(
                '$'+pageTotal_sold +' ( $'+ total_sold +' total)'
            );
            $( api.column( 13 ).header('.sum') ).html(
                '$'+pageTotal_margin +' ( $'+ total_margin +' total)'
            );
        }
    };
    
    let table = $('.datatable-Shippmentslist').DataTable(dtOverrideGlobals);
   
    let visibleColumnsIndexes = null;
    $('.datatable thead').on('input', '.search', function () {
        let strict = $(this).attr('strict') || false
        let value = strict && this.value ? "^" + this.value + "$" : this.value

        let index = $(this).parent().index()
        if (visibleColumnsIndexes !== null) {
            index = visibleColumnsIndexes[index]
        }

        table
            .column(index)
            .search(value, strict)
            .draw()
    });
    table.on('column-visibility.dt', function(e, settings, column, state) {
        visibleColumnsIndexes = []
        table.columns(":visible").every(function(colIdx) {
            visibleColumnsIndexes.push(colIdx);
        });
    })
});

</script>
@endsection