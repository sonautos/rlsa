@extends('layouts.admin')

@section('styles') 
    <style>
        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
    </style>
@endsection

@section('content')

@can('car_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="btn-group mx-auto" role="group" aria-label="">
            <a type="button" class="btn btn-outline-success" href="{{ route('admin.cars.create') }}">+</a>
            {{-- <a type="button" class="btn btn-outline-success" href="{{ route('admin.cars.massImport') }}">++</a> --}}
            @include('carImport.modal')
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#csvImportModal">+++</button>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.car.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="card shadow-lg rounded p-3">
            <form id="createOrder" action="{{ route('admin.order.create') }}" method="GET">
                @csrf
                <div class="float-right">
                    <button type="submit" class="btn-success rounded p-1 m-2">{{trans('global.new-order')}}</button>
                </div>
            </form>
            <table class="table table-sm table-hover display nowrap compact ajaxTable datatable text-center datatable datatable-Car">
                <thead>
                    <tr>
                        <th width="5">
                            <input type="checkbox" name="select_all" value="1" id="cars-select-all">
                        </th>
                        <th>{{ trans('cruds.car.fields.image') }}</th>
                        <th>{{ trans('trans.stock') }}</th>
                        <th>More</th>
                        <th>{{ trans('cruds.car.fields.entity') }}</th>
                        <th>{{ trans('cruds.car.fields.seller') }}</th>
                        <th>{{ trans('cruds.car.fields.categorie') }}</th>
                        <th>{{ trans('cruds.car.fields.vin') }}</th>
                        <th>{{ trans('cruds.car.fields.name') }}</th>
                        <th>{{ trans('cruds.car.fields.mec') }}</th>
                        <th>{{ trans('cruds.car.fields.kms') }}</th>
                        <th>{{ trans('cruds.car.fields.color') }}</th>
                        <th>{{ trans('cruds.car.fields.frevo') }}</th>
                        <th>{{ trans('cruds.car.fields.price_ht') }}</th>
                        <th>{{ trans('cruds.car.fields.active') }}</th>
                        <th>{{ trans('cruds.car.fields.draft') }}</th>
                        <th>{{ trans('cruds.car.fields.dispo') }}</th>
                        <th>{{ trans('cruds.car.fields.warehouse') }}</th>
                        <th>{{ trans('cruds.car.fields.comseller') }}</th>
                        <th>{{ trans('cruds.car.fields.import_key') }}</th>
                        <th>{{ trans('cruds.car.fields.tags') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <select class="search" id="stock">
                                <option value="">{{trans('global.all')}}</option>
                                <option value="1">{{trans('trans.stock')}}</option>
                                <option value="0">{{trans('trans.sold')}}</option>
                            </select>
                        </td>
                        <td></td>
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
                                @foreach($companies->where('supplier', 1) as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($product_categories as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($product_tags as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('car_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.cars.massDestroy') }}",
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

    // let searchButtonsTrans = '{{ trans('global.datatables.search') }}';
    // let searchButton = {
    //     text: searchButtonsTrans,
    //     className: 'btn-success',
    //     extend: 'searchPanes',
    //     config: {
    //         show: true,
    //     }
    // }
    // dtButtons.push(searchButton)

    // let hidden_row = [ 4,6,7,15,16,17,18,19,20,21,22];
    let dtOverrideGlobals = {
        buttons: dtButtons,
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: "{{ route('admin.cars.index') }}",
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false},
            { data: 'image', name: 'image', sortable: false, searchable: false },
            { data: 'qty', name: 'qty' },
            {
                className: 'details-control',
                orderable: false,
                data: null,
                defaultContent: '',
                searchable: false
            },
            { data: 'entity_name', name: 'entity.name' },
            { data: 'seller_name', name: 'seller.name' },
            { data: 'categorie', name: 'categories.name' },
            { data: 'vin', name: 'vin' },
            { data: 'name', name: 'name' },
            { data: 'mec', name: 'mec' },
            { data: 'kms', name: 'kms' },
            { data: 'color', name: 'color' },
            { data: 'frevo', name: 'frevo' },
            { data: 'price_ht', name: 'price_ht' },
            { data: 'active', name: 'active' },
            { data: 'draft', name: 'draft' },
            { data: 'dispo', name: 'dispo' },
            { data: 'warehouse', name: 'warehouse' },
            { data: 'comseller', name: 'comseller'  },
            { data: 'import_key', name: 'import_key' },
            { data: 'tags', name: 'tags.name' },
            { data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false },
            { data: 'plates', name: 'plates', visible: false  },
            { data: 'idv', name: 'idv', visible: false  },
            { data: 'energy', name: 'energy', visible: false },
            { data: 'gear', name: 'gear', visible: false },
        ],
        columnDefs: [
            {
                targets: 0,
                checkboxes: {
                    selectRow: true
                }
            }
        ],
        select: 
        {
            style: 'multi'
        },
        searchCols: [
                null,
                null,
                { search: "1" },
            ],
        orderCellsTop: true,
        order: [[ 11, 'asc' ]],
        pageLength: 100,
    };
    let table = $('.datatable-Car').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    /* SHOW MORE DETAIL */
    function format ( d ) {
        // `d` is the original data object for the row
        return '<div class="card w-75">'+
            '<div class="card-body">'+
                '<div class="row">'+
                    '<div class="col-2 text-left">'+
                        '<ul class="list-group">'+
                            '<li class="list-group-item">{{ trans("vehicle.make")}} : '+d.make+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.modele")}} : '+d.modele+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.version")}} : '+d.version.description+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.motor")}} : '+d.version.motor+'</li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="col-2 text-left">'+
                        '<ul class="list-group">'+
                            '<li class="list-group-item">{{ trans("vehicle.idv")}} : '+d.idv+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.plates")}} : '+d.plates+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.stock")}} : '+d.qty+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.real_frevo")}} : '+d.real_frevo+'</li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="col-2 text-left">'+
                        '<ul class="list-group">'+
                            '<li class="list-group-item">{{ trans("vehicle.ch")}} : '+d.co_2+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.modele")}} : '+d.ch+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.energy")}} : '+d.energy+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.gear")}} : '+d.gear+'</li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="col-6 text-left">'+
                        '<ul class="list-group">'+
                            '<li class="list-group-item">{{ trans("vehicle.features")}} : '+d.feature+'</li>'+
                            '<li class="list-group-item">{{ trans("vehicle.serie")}} : '+d.serie+'</li>'+
                        '</ul>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';;
    }
    $('.datatable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
        // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
    // END SHOW MORE DETAIL

    // Order Create
    // // Handle click on "Select all" control
    $('#cars-select-all').on('click', function(){
            // Get all rows with search applied
            var rows = table.rows({ 'search': 'applied' }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
    $('#datatable-Car tbody').on('change', 'input[type="checkbox"]', function(){
    // If checkbox is not checked
        if(!this.checked){
            var el = $('#cars-select-all').get(0);
            // If "Select all" control is checked and has 'indeterminate' property
            if(el && el.checked && ('indeterminate' in el)){
                // Set visual state of "Select all" control
                // as 'indeterminate'
                el.indeterminate = true;
            }
        }
    });

    $('#createOrder').on('submit', function(e){
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
    document.getElementById("stock").selectedIndex = 1;

</script>

@endsection