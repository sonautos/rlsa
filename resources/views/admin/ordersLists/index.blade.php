@extends('layouts.admin')
@section('content')
@can('orders_list_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.orders-lists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ordersList.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'OrdersList', 'route' => 'admin.orders-lists.parseCsvImport'])
        </div>
    </div>
@endcan

<div class="card shadow-xl">
    <table cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
        <thead>
            <tr>
                <th>Target</th>
                <th>Search text</th>
            </tr>
        </thead>
        <tbody>
            <tr id="filter_global">
                <td>Global search</td>
                <td align="center"><input type="text" class="global_filter form-control" id="global_filter"></td>
            </tr>
            <tr id="filter_col1" data-column="2">
                <td>{{ trans('cruds.ordersList.fields.ref')}}</td>
                <td align="center"><input type="text" class="column_filter form-control" id="col2_filter"></td>
            </tr>
            <tr id="table-filter">
                <td>{{ trans('trans.test')}}</td>
                <td>
                    <select class="column_select form-control">
                    <option value>{{ trans('global.all') }}</option>
                    @foreach($companies->where('supplier', 1) as $key => $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.ordersList.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table display nowrap table-hover ajaxTable datatable datatable-OrdersList">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.ref') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.entity') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.seller') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.task') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.date_created') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.date_valid') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.author') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.valid') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.user_updated') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.total_ht') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.tva') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.total_ttc') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.remise') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.remise_percent') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.cond_reglement') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.mode_reglement') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.note_private') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.note_public') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.date_livraison') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.shipping_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.delivery_address') }}
                    </th>
                    <th>
                        {{ trans('cruds.address.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordersList.fields.signed') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
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
                            @foreach($companies as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($tasks as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
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
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($order_statuses as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($cond_reglements as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($mode_reglements as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($shipping_methods as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($addresses as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
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
        @can('orders_list_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.orders-lists.massDestroy') }}",
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

        let hidden_row = [1,6,8,10,11,12,13,14,17,18,19,20,21,22,23,24,26,27,28 ];

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.orders-lists.index') }}",
            columnDefs: [
                {
                    targets: hidden_row,
                    visible: false,
                }
            ],
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'id', name: 'id' },
                { data: 'ref', name: 'ref' },
                { data: 'entity_name', name: 'entity.name' },
                { data: 'seller_name', name: 'seller.name' },
                { data: 'client_name', name: 'client.name' },
                { data: 'task_name', name: 'task.name' },
                { data: 'date_created', name: 'date_created' },
                { data: 'date_valid', name: 'date_valid' },
                { data: 'author_firstname', name: 'author.firstname' },
                { data: 'author.name', name: 'author.name' },
                { data: 'valid_firstname', name: 'valid.firstname' },
                { data: 'valid.name', name: 'valid.name' },
                { data: 'user_updated_firstname', name: 'user_updated.firstname' },
                { data: 'user_updated.name', name: 'user_updated.name' },
                { data: 'status_name', name: 'status.name' },
                { data: 'total_ht', name: 'total_ht' },
                { data: 'tva', name: 'tva' },
                { data: 'total_ttc', name: 'total_ttc' },
                { data: 'remise', name: 'remise' },
                { data: 'remise_percent', name: 'remise_percent' },
                { data: 'cond_reglement_name', name: 'cond_reglement.name' },
                { data: 'mode_reglement_name', name: 'mode_reglement.name' },
                { data: 'note_private', name: 'note_private' },
                { data: 'note_public', name: 'note_public' },
                { data: 'date_livraison', name: 'date_livraison' },
                { data: 'shipping_method_name', name: 'shipping_method.name' },
                { data: 'delivery_address_name', name: 'delivery_address.name' },
                { data: 'delivery_address.name', name: 'delivery_address.name' },
                { data: 'signed', name: 'signed' },
                { data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false }
            ],
            orderCellsTop: true,
            order: [[ 7, 'desc' ]],
            pageLength: 100,
            initComplete: function(settings){
                var api = new $.fn.dataTable.Api( settings );
                $('.table-filter-container', api.table().container()).append(
                    $('#table-filter').detach().show()
                );
                
                $('#table-filter select').on('change', function(){
                    table.search(this.value).draw();   
                });       
            }
        };
        
        let table = $('.datatable-OrdersList').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        $('input.global_filter').on( 'keyup click', function () {
            filterGlobal();
        } );
    
        $('input.column_filter').on( 'keyup click', function () {
            filterColumn( $(this).parents('tr').attr('data-column') );
        } );

        $('#column_select').on( 'keyup click', function () {
            filterColumn( $(this).parents('tr').attr('data-column') );
        } );

        // $('#table-filter').on('change', function(){
        //     table.search(this.value).draw();   
        // });

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

    function filterGlobal () {
        $('.datatable').DataTable().search(
            $('#global_filter').val(),
            $('#global_regex').prop('checked'),
            $('#global_smart').prop('checked')
        ).draw();
    }
    
    function filterColumn ( i ) {
        $('.datatable').DataTable().column( i ).search(
            $('#col'+i+'_filter').val(),
            $('#col'+i+'_regex').prop('checked'),
            $('#col'+i+'_smart').prop('checked')
        ).draw();
    }

    function filterColumnSelect ( i ) {
        $('.datatable').DataTable().column( i ).search(
            $( '#col'+i+'_select').val(),
        ).draw();
    }

</script>
@endsection
