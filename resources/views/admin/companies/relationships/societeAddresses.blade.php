<div class="m-3">
    @can('address_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.addresses.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.address.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.address.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-societeAddresses">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.address.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.societe') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.entity') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.individual') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.firstname') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.fonction') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.address_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.zip') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.state') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.country') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.mobile') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.user_create') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.user_modif') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.note_private') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.note_public') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.tags') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.latitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.longitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.url_place') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($addresses as $key => $address)
                            <tr data-entry-id="{{ $address->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $address->id ?? '' }}
                                </td>
                                <td>
                                    {{ $address->societe->name ?? '' }}
                                </td>
                                <td>
                                    {{ $address->entity->name ?? '' }}
                                </td>
                                <td>
                                    {{ $address->individual->lastname ?? '' }}
                                </td>
                                <td>
                                    {{ $address->individual->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $address->fonction ?? '' }}
                                </td>
                                <td>
                                    {{ $address->name ?? '' }}
                                </td>
                                <td>
                                    {{ $address->address ?? '' }}
                                </td>
                                <td>
                                    {{ $address->address_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $address->zip ?? '' }}
                                </td>
                                <td>
                                    {{ $address->city ?? '' }}
                                </td>
                                <td>
                                    {{ $address->state ?? '' }}
                                </td>
                                <td>
                                    {{ $address->country ?? '' }}
                                </td>
                                <td>
                                    {{ $address->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $address->mobile ?? '' }}
                                </td>
                                <td>
                                    {{ $address->email ?? '' }}
                                </td>
                                <td>
                                    {{ $address->user_create->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $address->user_create->name ?? '' }}
                                </td>
                                <td>
                                    {{ $address->user_modif->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $address->user_modif->name ?? '' }}
                                </td>
                                <td>
                                    {{ $address->note_private ?? '' }}
                                </td>
                                <td>
                                    {{ $address->note_public ?? '' }}
                                </td>
                                <td>
                                    @foreach($address->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->tag }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $address->latitude ?? '' }}
                                </td>
                                <td>
                                    {{ $address->longitude ?? '' }}
                                </td>
                                <td>
                                    {{ $address->url_place ?? '' }}
                                </td>
                                <td>
                                    @can('address_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.addresses.show', $address->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('address_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.addresses.edit', $address->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('address_delete')
                                        <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('address_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.addresses.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-societeAddresses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection