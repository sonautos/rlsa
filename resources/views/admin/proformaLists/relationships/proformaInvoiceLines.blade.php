<div class="m-3">
    @can('invoice_line_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.invoice-lines.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.invoiceLine.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.invoiceLine.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-proformaInvoiceLines">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.proforma') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.service') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.vehicle') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.qty') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.tva_tx') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.remise_percent') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.remise') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.total_ht') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.total_tva') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.total_ttc') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.cost_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.comclient') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoiceLine.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoiceLines as $key => $invoiceLine)
                            <tr data-entry-id="{{ $invoiceLine->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $invoiceLine->id ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->proforma->ref ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->service->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->vehicle->vin ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->description ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->qty ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->tva_tx ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->remise_percent ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->remise ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->total_ht ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->total_tva ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->total_ttc ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->cost_price ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->comclient ?? '' }}
                                </td>
                                <td>
                                    {{ $invoiceLine->status->name ?? '' }}
                                </td>
                                <td>
                                    @can('invoice_line_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.invoice-lines.show', $invoiceLine->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('invoice_line_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.invoice-lines.edit', $invoiceLine->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('invoice_line_delete')
                                        <form action="{{ route('admin.invoice-lines.destroy', $invoiceLine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('invoice_line_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.invoice-lines.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-proformaInvoiceLines:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection