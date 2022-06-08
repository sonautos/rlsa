<div class="m-3">
    @can('company_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.companies.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-tagsCompanies">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.company.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.entity') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.alias') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.supplier') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.parent') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.code_client') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.code_supplier') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.address_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.zip') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.state') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.country') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.siren') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.siret') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.ape') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.vatnumber') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.capital') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.note_private') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.note_public') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.active') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.tags') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.latitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.longitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.company.fields.url_place') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $key => $company)
                            <tr data-entry-id="{{ $company->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $company->id ?? '' }}
                                </td>
                                <td>
                                    {{ $company->entity->name ?? '' }}
                                </td>
                                <td>
                                    {{ $company->name ?? '' }}
                                </td>
                                <td>
                                    {{ $company->alias ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $company->supplier ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $company->supplier ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $company->status ?? '' }}
                                </td>
                                <td>
                                    {{ $company->parent ?? '' }}
                                </td>
                                <td>
                                    {{ $company->code_client ?? '' }}
                                </td>
                                <td>
                                    {{ $company->code_supplier ?? '' }}
                                </td>
                                <td>
                                    {{ $company->address ?? '' }}
                                </td>
                                <td>
                                    {{ $company->address_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $company->zip ?? '' }}
                                </td>
                                <td>
                                    {{ $company->city ?? '' }}
                                </td>
                                <td>
                                    {{ $company->state ?? '' }}
                                </td>
                                <td>
                                    {{ $company->country ?? '' }}
                                </td>
                                <td>
                                    {{ $company->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $company->email ?? '' }}
                                </td>
                                <td>
                                    {{ $company->siren ?? '' }}
                                </td>
                                <td>
                                    {{ $company->siret ?? '' }}
                                </td>
                                <td>
                                    {{ $company->ape ?? '' }}
                                </td>
                                <td>
                                    {{ $company->vatnumber ?? '' }}
                                </td>
                                <td>
                                    {{ $company->capital ?? '' }}
                                </td>
                                <td>
                                    {{ $company->note_private ?? '' }}
                                </td>
                                <td>
                                    {{ $company->note_public ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $company->active ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $company->active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @if($company->photo)
                                        <a href="{{ $company->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $company->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @foreach($company->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->tag }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $company->latitude ?? '' }}
                                </td>
                                <td>
                                    {{ $company->longitude ?? '' }}
                                </td>
                                <td>
                                    {{ $company->url_place ?? '' }}
                                </td>
                                <td>
                                    @can('company_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.companies.show', $company->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('company_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.companies.edit', $company->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('company_delete')
                                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.companies.massDestroy') }}",
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
    order: [[ 3, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-tagsCompanies:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection