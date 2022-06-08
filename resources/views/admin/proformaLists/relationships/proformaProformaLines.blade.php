<div class="m-3">
    @can('proforma_line_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.proforma-lines.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.proformaLine.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.proformaLine.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-proformaProformaLines">
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
                    </thead>
                    <tbody>
                        @foreach($proformaLines as $key => $proformaLine)
                            <tr data-entry-id="{{ $proformaLine->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $proformaLine->id ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->proforma->ref ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->service->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->vehicle->vin ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->description ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->qty ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->tva_tx ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->remise_percent ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->remise ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->total_ht ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->total_tva ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->total_ttc ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->cost_price ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->comclient ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaLine->status->name ?? '' }}
                                </td>
                                <td>
                                    @can('proforma_line_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.proforma-lines.show', $proformaLine->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('proforma_line_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.proforma-lines.edit', $proformaLine->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('proforma_line_delete')
                                        <form action="{{ route('admin.proforma-lines.destroy', $proformaLine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('proforma_line_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.proforma-lines.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-proformaProformaLines:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection