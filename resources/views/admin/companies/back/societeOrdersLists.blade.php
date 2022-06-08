<div class="m-3">
    @can('orders_list_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.orders-lists.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.ordersList.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.ordersList.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-societeOrdersLists">
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
                                {{ trans('cruds.ordersList.fields.societe') }}
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
                    </thead>
                    <tbody>
                        @foreach($ordersLists as $key => $ordersList)
                            <tr data-entry-id="{{ $ordersList->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $ordersList->id ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->ref ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->entity->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->societe->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->task->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->date_created ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->date_valid ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->author->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->author->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->valid->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->valid->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->user_updated->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->user_updated->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->status->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->total_ht ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->tva ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->total_ttc ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->remise ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->remise_percent ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->cond_reglement->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->mode_reglement->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->note_private ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->note_public ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->date_livraison ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->shipping_method->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->delivery_address->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ordersList->delivery_address->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $ordersList->signed ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $ordersList->signed ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('orders_list_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.orders-lists.show', $ordersList->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('orders_list_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.orders-lists.edit', $ordersList->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('orders_list_delete')
                                        <form action="{{ route('admin.orders-lists.destroy', $ordersList->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('orders_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders-lists.massDestroy') }}",
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
  let table = $('.datatable-societeOrdersLists:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection