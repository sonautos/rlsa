@extends('layouts.admin')
@section('content')
@can('shipp_line_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.shipp-lines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.shippLine.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ShippLine', 'route' => 'admin.shipp-lines.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.shippLine.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table display nowrap table-hover ajaxTable datatable datatable-ShippLine">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.seller') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.modele') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.vehicle') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.vin') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.color') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.plates') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.loading_place') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.delivery_place') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.cmr_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.shippment') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippLine.fields.order') }}
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
                            @foreach($companies as $key => $item)
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($shippmentslists as $key => $item)
                                <option value="{{ $item->ref }}">{{ $item->ref }}</option>
                            @endforeach
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
@can('shipp_line_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.shipp-lines.massDestroy') }}",
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
    ajax: "{{ route('admin.shipp-lines.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'seller_name', name: 'seller.name' },
{ data: 'client_name', name: 'client.name' },
{ data: 'modele', name: 'modele' },
{ data: 'vehicle_vin', name: 'vehicle.vin' },
{ data: 'vin', name: 'vin' },
{ data: 'color', name: 'color' },
{ data: 'plates', name: 'plates' },
{ data: 'loading_place', name: 'loading_place' },
{ data: 'delivery_place', name: 'delivery_place' },
{ data: 'cmr_date', name: 'cmr_date' },
{ data: 'status_name', name: 'status.name' },
{ data: 'price', name: 'price' },
{ data: 'paid', name: 'paid' },
{ data: 'shippment_ref', name: 'shippment.ref' },
{ data: 'user_firstname', name: 'user.firstname' },
{ data: 'user.name', name: 'user.name' },
{ data: 'order_ref', name: 'order.ref' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 11, 'asc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ShippLine').DataTable(dtOverrideGlobals);
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