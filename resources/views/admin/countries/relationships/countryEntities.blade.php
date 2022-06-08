<div class="m-3">
    @can('entity_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.entities.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.entity.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.entity.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-countryEntities">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.alias') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.supplier') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.parent') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.code_client') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.code_supplier') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.address_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.zip') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.state') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.province') }}
                            </th>
                            <th>
                                {{ trans('cruds.province.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.country') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.siren') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.siret') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.ape') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.vatnumber') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.capital') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.note_private') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.note_public') }}
                            </th>
                            <th>
                                {{ trans('cruds.entity.fields.active') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entities as $key => $entity)
                            <tr data-entry-id="{{ $entity->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $entity->id ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->name ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->alias ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $entity->supplier ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $entity->supplier ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $entity->status ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->parent ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->code_client ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->code_supplier ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->address ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->address_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->zip ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->city ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->state->name ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->province->name ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->province->name ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->country->name ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->email ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->siren ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->siret ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->ape ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->vatnumber ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->capital ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->note_private ?? '' }}
                                </td>
                                <td>
                                    {{ $entity->note_public ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $entity->active ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $entity->active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('entity_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.entities.show', $entity->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('entity_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.entities.edit', $entity->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('entity_delete')
                                        <form action="{{ route('admin.entities.destroy', $entity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('entity_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.entities.massDestroy') }}",
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
    order: [[ 2, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-countryEntities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection