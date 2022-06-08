@extends('layouts.admin')

@section('styles')
<style>
    div.datatable-wide {
        padding-top: 0;
        padding-bottom: 0;
    }
</style>
@endsection

@section('content')
@can('company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.companies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Company', 'route' => 'admin.companies.parseCsvImport'])
        </div>
    </div>
@endcan

<div>

</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="card shadow-lg rounded p-3">
        <form  id="createOrder" action="{{ route('admin.companies.massActive') }}" method="POST">
        @csrf
        <div class="float-right">
            <button type="submit" class="btn-success rounded p-1 m-2">{{trans('global.mass-active')}}</button>
        </div>
        <table class="table table-sm table-hover compact ajaxTable datatable  text-center datatable-Company" style="font-size: 12px">
            <thead>
                <tr>
                    <th width="5">
                        <input type="checkbox" name="select_all" value="1" id="example-select-all" name="checkbox">
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.alias') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.supplier') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.country') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.active') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.tags') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td></td>
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
                            @foreach($tag_contacts as $key => $item)
                                <option value="{{ $item->tag }}">{{ $item->tag }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
        </form>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('company_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.companies.massDestroy') }}",
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
                        data: { ids: ids, _method: 'DELETE' }
                    })
                    .done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.companies.index') }}",

            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'alias', name: 'alias' },
                { data: 'supplier', name: 'supplier' },
                { data: 'city', name: 'city' },
                { data: 'state', name: 'state' },
                { data: 'country', name: 'country' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'active', name: 'active' },
                { data: 'tags', name: 'tags.tag' },
                { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            orderCellsTop: true,
            order: [[ 1, 'asc' ]],
            pageLength: 100,
        };

        // // Handle click on "Select all" control
        $('#example-select-all').on('click', function(){
            // Get all rows with search applied
            var rows = table.rows({ 'search': 'applied' }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
        $('#example tbody').on('change', 'input[type="checkbox"]', function(){
        // If checkbox is not checked
        if(!this.checked){
            var el = $('#example-select-all').get(0);
            // If "Select all" control is checked and has 'indeterminate' property
            if(el && el.checked && ('indeterminate' in el)){
                // Set visual state of "Select all" control
                // as 'indeterminate'
                el.indeterminate = true;
            }
        }
        });

        let table = $('.datatable-Company').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
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

        // Handle form submission event
        $('#createOrder').on('submit', function(e){
        var form = this;

        // Iterate over all checkboxes in the table
        table.$('input[type="checkbox"]').each(function(){
            // If checkbox doesn't exist in DOM
            if(!$.contains(document, this)){
                // If checkbox is checked
                if(this.checked){
                    // Create a hidden element
                    $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('id', this.id)
                        .val(this.value)
                    );
                }
            }
        });
        });
    });

</script>
@endsection
