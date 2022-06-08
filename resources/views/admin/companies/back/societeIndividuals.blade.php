<div class="m-3">
    @can('individual_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.individuals.create') }}" method="GET">
                @csrf
                    <input type="text" name="companyId" id="" value="{{ $company->id }}" hidden>
                    <button class="btn btn-success" type="submit" href="">
                    {{ trans('global.add') }} {{ trans('cruds.individual.title_singular') }}
                    </button>
                </form>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.individual.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-societeIndividuals">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.societe') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.entity') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.civility') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.firstname') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.lastname') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.address_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.zip') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.state') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.country') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.poste') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.mobile') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.user_create') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.user_modif') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.note_private') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.note_public') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.tags') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.latitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.longitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.individual.fields.url_place') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($individuals as $key => $individual)
                            <tr data-entry-id="{{ $individual->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $individual->id ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->societe->name ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->entity->name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Individual::CIVILITY_RADIO[$individual->civility] ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->lastname ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->address ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->address_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->zip ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->city ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->state ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->country ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->poste ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->mobile ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->email ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->user_create->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->user_create->name ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->user_modif->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->user_modif->name ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->note_private ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->note_public ?? '' }}
                                </td>
                                <td>
                                    @if($individual->photo)
                                        <a href="{{ $individual->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $individual->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @foreach($individual->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->tag }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $individual->latitude ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->longitude ?? '' }}
                                </td>
                                <td>
                                    {{ $individual->url_place ?? '' }}
                                </td>
                                <td>
                                    @can('individual_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.individuals.show', $individual->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('individual_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.individuals.edit', $individual->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('individual_delete')
                                        <form action="{{ route('admin.individuals.destroy', $individual->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('individual_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.individuals.massDestroy') }}",
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
  let table = $('.datatable-societeIndividuals:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
