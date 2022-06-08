<div class="m-3">
    @can('truck_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.trucks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.truck.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.truck.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-shippmentTrucks">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.supplier') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.plates') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.chauffeur') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.date_load') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.date_cmr') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.paid') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.shippment') }}
                            </th>
                            <th>
                                {{ trans('cruds.truck.fields.cmr') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trucks as $key => $truck)
                            <tr data-entry-id="{{ $truck->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $truck->id ?? '' }}
                                </td>
                                <td>
                                    {{ $truck->supplier->name ?? '' }}
                                </td>
                                <td>
                                    {{ $truck->plates ?? '' }}
                                </td>
                                <td>
                                    {{ $truck->chauffeur ?? '' }}
                                </td>
                                <td>
                                    {{ $truck->price ?? '' }}
                                </td>
                                <td>
                                    {{ $truck->date_load ?? '' }}
                                </td>
                                <td>
                                    {{ $truck->date_cmr ?? '' }}
                                </td>
                                <td>
                                    {{ $truck->status ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $truck->paid ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $truck->paid ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $truck->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $truck->shippment->ref ?? '' }}
                                </td>
                                <td>
                                    @if($truck->cmr)
                                        <a href="{{ $truck->cmr->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can('truck_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.trucks.show', $truck->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('truck_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.trucks.edit', $truck->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('truck_delete')
                                        <form action="{{ route('admin.trucks.destroy', $truck->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('truck_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.trucks.massDestroy') }}",
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
  let table = $('.datatable-shippmentTrucks:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection