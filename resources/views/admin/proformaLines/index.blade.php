@extends('layouts.admin')
@section('content')
@can('proforma_line_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.proforma-lines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.proformaLine.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ProformaLine', 'route' => 'admin.proforma-lines.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.proformaLine.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProformaLine">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.proforma') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.service') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.vehicle') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.qty') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.tva_tx') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.remise_percent') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.remise') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.total_ht') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.total_tva') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.total_ttc') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.cost_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.comclient') }}
                    </th>
                    <th>
                        {{ trans('cruds.proformaLine.fields.status') }}
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($proforma_lists as $key => $item)
                                <option value="{{ $item->ref }}">{{ $item->ref }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($products as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($services as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
@can('proforma_line_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.proforma-lines.massDestroy') }}",
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.proforma-lines.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'proforma_ref', name: 'proforma.ref' },
{ data: 'product_name', name: 'product.name' },
{ data: 'service_name', name: 'service.name' },
{ data: 'vehicle_vin', name: 'vehicle.vin' },
{ data: 'name', name: 'name' },
{ data: 'description', name: 'description' },
{ data: 'qty', name: 'qty' },
{ data: 'tva_tx', name: 'tva_tx' },
{ data: 'remise_percent', name: 'remise_percent' },
{ data: 'remise', name: 'remise' },
{ data: 'total_ht', name: 'total_ht' },
{ data: 'total_tva', name: 'total_tva' },
{ data: 'total_ttc', name: 'total_ttc' },
{ data: 'cost_price', name: 'cost_price' },
{ data: 'comclient', name: 'comclient' },
{ data: 'status_name', name: 'status.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ProformaLine').DataTable(dtOverrideGlobals);
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
});

</script>
@endsection