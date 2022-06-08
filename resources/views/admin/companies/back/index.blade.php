@extends('layouts.admin')
@section('content')
@can('company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.companies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Company', 'route' => 'admin.companies.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Company">
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
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($entities as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($tag_contacts as $key => $item)
                                <option value="{{ $item->tag }}">{{ $item->tag }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
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
@can('company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.companies.massDestroy') }}",
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
    ajax: "{{ route('admin.companies.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'entity_name', name: 'entity.name' },
{ data: 'name', name: 'name' },
{ data: 'alias', name: 'alias' },
{ data: 'supplier', name: 'supplier' },
{ data: 'status', name: 'status' },
{ data: 'parent', name: 'parent' },
{ data: 'code_client', name: 'code_client' },
{ data: 'code_supplier', name: 'code_supplier' },
{ data: 'address', name: 'address' },
{ data: 'address_2', name: 'address_2' },
{ data: 'zip', name: 'zip' },
{ data: 'city', name: 'city' },
{ data: 'state', name: 'state' },
{ data: 'country', name: 'country' },
{ data: 'phone', name: 'phone' },
{ data: 'email', name: 'email' },
{ data: 'siren', name: 'siren' },
{ data: 'siret', name: 'siret' },
{ data: 'ape', name: 'ape' },
{ data: 'vatnumber', name: 'vatnumber' },
{ data: 'capital', name: 'capital' },
{ data: 'note_private', name: 'note_private' },
{ data: 'note_public', name: 'note_public' },
{ data: 'active', name: 'active' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'tags', name: 'tags.tag' },
{ data: 'latitude', name: 'latitude' },
{ data: 'longitude', name: 'longitude' },
{ data: 'url_place', name: 'url_place' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'asc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Company').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection