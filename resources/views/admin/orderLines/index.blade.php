@extends('layouts.admin')
@section('content')
@can('order_line_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.order-lines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.orderLine.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'OrderLine', 'route' => 'admin.order-lines.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.orderLine.title_singular') }} {{ trans('global.list') }}
    </div>
    <form id="createProforma" action="{{ route('admin.proforma-lists.createFromOrder') }}" method="GET">
        @csrf
        <div class="float-right">
            <button type="submit" class="btn-success rounded p-1 m-2">{{trans('global.proforma-create')}}</button>
        </div>
    </form>
    <form id="createShippment" action="{{ route('admin.shippmentslists.create') }}" method="GET">
        @csrf
        <div class="float-right">
            <button type="submit" class="btn-success rounded p-1 m-2">{{trans('global.shippment-create')}}</button>
        </div>
    </form>
    <div class="card-body">
        <table class=" table  display nowrap table-hover ajaxTable datatable datatable-OrderLine">
            <thead>
                <tr>
                    <th width="10">
                        <input type="checkbox" name="select_all" value="1" id="cars-select-all">
                    </th>
                    <th>
                        {{ trans('cruds.orderLine.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderLine.fields.order') }}
                    </th>
                    <th>
                        {{ trans('trans.seller') }}
                    </th>
                    <th>
                        {{ trans('trans.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderLine.fields.vehicle') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderLine.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderLine.fields.total_ht') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderLine.fields.comclient') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <select class="search" id="status">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($order_statuses as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($orders_lists as $key => $item)
                                <option value="{{ $item->ref }}">{{ $item->ref }}</option>
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
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($cars as $key => $item)
                                <option value="{{ $item->vin }}">{{ $item->vin }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td></td>
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
        @can('order_line_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.order-lines.massDestroy') }}",
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

        let createProforma = '{{ trans('global.datatables.create') }}';
        let createProformaButton = {
            text: createProforma,
            url: "{{ route('admin.proforma-lists.create') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                    return entry.id
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')

                    return
                }

                if (confirm('{{ trans('global.areYouSure') }}'))  {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'GET',
                        url: "{{ route('admin.proforma-lists.create') }}",
                        data: {
                            'ids': ids
                        },
                        success: function( data, test ){
                            // console.log(data.value);
                            window.location.href = "{{route('admin.proforma-lists.create')}}"+"?rowid=[" + ids + "]";
                            // console.log(data);
                        },
                        error: function (xhr, b, c) {
                            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                        }
                    })
                }
            }
        }
        dtButtons.push(createProformaButton)

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.order-lines.index') }}",
            columnDefs: [
                {
                    targets: 0,
                    checkboxes: {
                        selectRow: true
                    }
                }
            ],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'status_name', name: 'status.name' },
                { data: 'order_ref', name: 'order.ref' },
                { data: 'order_seller', name: 'order.seller_id' },
                { data: 'order_client', name: 'order.client_id' },
                { data: 'vehicle_vin', name: 'vehicle.vin' },
                { data: 'name', name: 'name' },
                { data: 'total_ht', name: 'total_ht' },
                // { data: 'total_tva', name: 'total_tva' },
                // { data: 'total_ttc', name: 'total_ttc' },
                // { data: 'cost_price', name: 'cost_price' },
                { data: 'comclient', name: 'comclient' },
                { data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false }
            ],
            select: {
                style: 'multi'
            },
            orderCellsTop: true,
            order: [[ 2, 'desc' ]],
            searchCols: [
                null,
                { search: "draft" },
            ],
            pageLength: 100,
        };
        let table = $('.datatable-OrderLine').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        
        $('#createShippment').on('submit', function(e){
            var form = this;
            var rows_selected = table.column(0).checkboxes.selected();
            $.each(rows_selected, function(index, rowId){
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });
        });

        $('#createProforma').on('submit', function(e){
            var form = this;
            var rows_selected = table.column(0).checkboxes.selected();
            $.each(rows_selected, function(index, rowId){
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });
        });

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
