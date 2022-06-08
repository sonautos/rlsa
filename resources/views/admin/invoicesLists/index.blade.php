@extends('layouts.admin')
@section('content')
@can('invoices_list_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.invoices-lists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.invoicesList.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'InvoicesList', 'route' => 'admin.invoices-lists.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.invoicesList.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-InvoicesList">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.ref') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.entity') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.seller') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.task') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.date_created') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.date_valid') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.author') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.valid') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.user_updated') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.total_ht') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.tva') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.total_ttc') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.remise') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.remise_percent') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.cond_reglement') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.mode_reglement') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.note_private') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.note_public') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.date_livraison') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.shipping_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.delivery_address') }}
                    </th>
                    <th>
                        {{ trans('cruds.address.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoicesList.fields.paid') }}
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
@can('invoices_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.invoices-lists.massDestroy') }}",
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
    ajax: "{{ route('admin.invoices-lists.index') }}",
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
{ data: 'paid', name: 'paid' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 7, 'asc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-InvoicesList').DataTable(dtOverrideGlobals);
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