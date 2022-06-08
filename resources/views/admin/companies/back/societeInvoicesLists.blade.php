<div class="m-3">
    @can('invoices_list_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.invoices-lists.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.invoicesList.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.invoicesList.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-societeInvoicesLists">
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
                                {{ trans('cruds.invoicesList.fields.societe') }}
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
                    </thead>
                    <tbody>
                        @foreach($invoicesLists as $key => $invoicesList)
                            <tr data-entry-id="{{ $invoicesList->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $invoicesList->id ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->ref ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->entity->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->societe->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->task->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->date_created ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->date_valid ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->author->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->author->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->valid->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->valid->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->user_updated->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->user_updated->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->status->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->total_ht ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->tva ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->total_ttc ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->remise ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->remise_percent ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->cond_reglement->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->mode_reglement->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->note_private ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->note_public ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->date_livraison ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->shipping_method->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->delivery_address->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoicesList->delivery_address->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $invoicesList->paid ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $invoicesList->paid ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('invoices_list_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.invoices-lists.show', $invoicesList->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('invoices_list_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.invoices-lists.edit', $invoicesList->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('invoices_list_delete')
                                        <form action="{{ route('admin.invoices-lists.destroy', $invoicesList->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('invoices_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.invoices-lists.massDestroy') }}",
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
    order: [[ 6, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-societeInvoicesLists:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection