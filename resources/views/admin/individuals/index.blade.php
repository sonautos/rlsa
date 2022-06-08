@extends('layouts.admin')
@section('content')
@can('individual_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.individuals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.individual.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Individual', 'route' => 'admin.individuals.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.individual.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Individual">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('individual_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.individuals.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.individuals.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'societe_name', name: 'societe.name' },
{ data: 'entity_name', name: 'entity.name' },
{ data: 'civility', name: 'civility' },
{ data: 'firstname', name: 'firstname' },
{ data: 'lastname', name: 'lastname' },
{ data: 'address', name: 'address' },
{ data: 'address_2', name: 'address_2' },
{ data: 'zip', name: 'zip' },
{ data: 'city', name: 'city' },
{ data: 'state', name: 'state' },
{ data: 'country', name: 'country' },
{ data: 'poste', name: 'poste' },
{ data: 'phone', name: 'phone' },
{ data: 'mobile', name: 'mobile' },
{ data: 'email', name: 'email' },
{ data: 'user_create_firstname', name: 'user_create.firstname' },
{ data: 'user_create.name', name: 'user_create.name' },
{ data: 'user_modif_firstname', name: 'user_modif.firstname' },
{ data: 'user_modif.name', name: 'user_modif.name' },
{ data: 'note_private', name: 'note_private' },
{ data: 'note_public', name: 'note_public' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'tags', name: 'tags.tag' },
{ data: 'latitude', name: 'latitude' },
{ data: 'longitude', name: 'longitude' },
{ data: 'url_place', name: 'url_place' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Individual').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection