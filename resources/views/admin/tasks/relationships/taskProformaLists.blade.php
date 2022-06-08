<div class="m-3">
    @can('proforma_list_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.proforma-lists.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.proformaList.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.proformaList.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-taskProformaLists">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.ref') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.entity') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.seller') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.task') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.date_created') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.date_valid') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.author') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.valid') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.user_updated') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.total_ht') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.tva') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.total_ttc') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.remise') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.remise_percent') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.cond_reglement') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.mode_reglement') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.note_private') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.note_public') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.date_livraison') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.shipping_method') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.delivery_address') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.proformaList.fields.paid') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proformaLists as $key => $proformaList)
                            <tr data-entry-id="{{ $proformaList->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $proformaList->id ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->ref ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->entity->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->seller->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->task->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->date_created ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->date_valid ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->author->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->author->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->valid->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->valid->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->user_updated->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->user_updated->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->status->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->total_ht ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->tva ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->total_ttc ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->remise ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->remise_percent ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->cond_reglement->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->mode_reglement->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->note_private ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->note_public ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->date_livraison ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->shipping_method->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->delivery_address->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proformaList->delivery_address->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $proformaList->paid ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $proformaList->paid ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('proforma_list_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.proforma-lists.show', $proformaList->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('proforma_list_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.proforma-lists.edit', $proformaList->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('proforma_list_delete')
                                        <form action="{{ route('admin.proforma-lists.destroy', $proformaList->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('proforma_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.proforma-lists.massDestroy') }}",
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
    order: [[ 7, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-taskProformaLists:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection