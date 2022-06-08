<div class="m-3">
    @can('car_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.cars.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.car.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.car.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-versionCars">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.car.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.firstname') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.entity') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.seller') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.country') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.categorie') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.vin') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.plates') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.idv') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.private_note') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.code_model') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.make') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.modele') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.version') }}
                            </th>
                            <th>
                                {{ trans('cruds.version.fields.motor') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.motor') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.ch') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.co_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.energy') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.gear') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.conso') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.image') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.mec') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.kms') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.color') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.interior') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.price_new') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.frevo') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.real_frevo') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.link_frevo') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.discount') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.price_ht') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.price_ttc') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.tax') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.last_price_update') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.cost_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.impuesto') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.active') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.qty') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.draft') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.dispo') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.warehouse') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.comseller') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.import_key') }}
                            </th>
                            <th>
                                {{ trans('cruds.car.fields.tags') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $key => $car)
                            <tr data-entry-id="{{ $car->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $car->id ?? '' }}
                                </td>
                                <td>
                                    {{ $car->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $car->user->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $car->entity->name ?? '' }}
                                </td>
                                <td>
                                    {{ $car->seller->name ?? '' }}
                                </td>
                                <td>
                                    {{ $car->country ?? '' }}
                                </td>
                                <td>
                                    @foreach($car->categories as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $car->vin ?? '' }}
                                </td>
                                <td>
                                    {{ $car->plates ?? '' }}
                                </td>
                                <td>
                                    {{ $car->idv ?? '' }}
                                </td>
                                <td>
                                    {{ $car->name ?? '' }}
                                </td>
                                <td>
                                    {{ $car->description ?? '' }}
                                </td>
                                <td>
                                    {{ $car->private_note ?? '' }}
                                </td>
                                <td>
                                    {{ $car->code_model->code ?? '' }}
                                </td>
                                <td>
                                    {{ $car->make ?? '' }}
                                </td>
                                <td>
                                    {{ $car->modele ?? '' }}
                                </td>
                                <td>
                                    {{ $car->version->description ?? '' }}
                                </td>
                                <td>
                                    {{ $car->version->motor ?? '' }}
                                </td>
                                <td>
                                    {{ $car->motor ?? '' }}
                                </td>
                                <td>
                                    {{ $car->ch ?? '' }}
                                </td>
                                <td>
                                    {{ $car->co_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $car->energy ?? '' }}
                                </td>
                                <td>
                                    {{ $car->gear ?? '' }}
                                </td>
                                <td>
                                    {{ $car->conso ?? '' }}
                                </td>
                                <td>
                                    @foreach($car->image as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $car->mec ?? '' }}
                                </td>
                                <td>
                                    {{ $car->kms ?? '' }}
                                </td>
                                <td>
                                    {{ $car->color ?? '' }}
                                </td>
                                <td>
                                    {{ $car->interior ?? '' }}
                                </td>
                                <td>
                                    {{ $car->price_new ?? '' }}
                                </td>
                                <td>
                                    {{ $car->frevo ?? '' }}
                                </td>
                                <td>
                                    {{ $car->real_frevo ?? '' }}
                                </td>
                                <td>
                                    {{ $car->link_frevo ?? '' }}
                                </td>
                                <td>
                                    {{ $car->discount ?? '' }}
                                </td>
                                <td>
                                    {{ $car->price_ht ?? '' }}
                                </td>
                                <td>
                                    {{ $car->price_ttc ?? '' }}
                                </td>
                                <td>
                                    {{ $car->tax ?? '' }}
                                </td>
                                <td>
                                    {{ $car->last_price_update ?? '' }}
                                </td>
                                <td>
                                    {{ $car->cost_price ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $car->impuesto ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $car->impuesto ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $car->active ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $car->active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $car->qty ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $car->draft ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $car->draft ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $car->dispo ?? '' }}
                                </td>
                                <td>
                                    {{ $car->warehouse ?? '' }}
                                </td>
                                <td>
                                    {{ $car->comseller ?? '' }}
                                </td>
                                <td>
                                    {{ $car->import_key ?? '' }}
                                </td>
                                <td>
                                    @foreach($car->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('car_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.cars.show', $car->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('car_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.cars.edit', $car->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('car_delete')
                                        <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('car_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cars.massDestroy') }}",
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
    order: [[ 11, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-versionCars:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection