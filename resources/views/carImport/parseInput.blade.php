@extends('layouts.admin')

@section('styles')
<style>
    /* Ensure that the demo table scrolls */

    table {
        font-size: small;
    }
    th {
        text-transform: uppercase;
    }
    th, td {
        white-space: nowrap;
    }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
    /* body {margin:2em;} */
    ul.dt-button-collection{
        background-color: #e5e5e5;
        border: 1px solid #c0c0c0;
    }
    li.dt-button a:hover{
        background-color: transparent;
        color: #115094;
        font-weight: bold;
    }
    li.dt-button.active a,
    li.dt-button.active a:hover,
    li.dt-button.active a:focus{
        color: #337ab6;
        background-color: transparent;
        font-weight: bold;
    }
    li.dt-button.active a::before{
        content: '✔ ';
    }
    .dataTables_info {
        font-size: 0.8em;
        margin-top: -12px;
        text-align: right;
    }
    .previous a,
    .next a
    {
        font-weight: bold;
    }
</style>
@endsection

@section('content')

            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div class="text-center">
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            @if (count($errors) > 0)
            <div class = "bg-danger text-black shadow text-center rounded-bottom">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            @if(session()->has('color'))
            <script>
            $(function() {
                $('#colorModal').modal('show');
            });
            </script>
            @include('carImport.modal-color')
            @endif
            <!-- Modal -->

<div class='row'>
    <div class='col-md-12'>
        <div class="card panel-default">
            <div class="card panel-default">
                <div class="card-header">
                    @lang('global.app_csvImport')
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if ($stock > 0)
                            <li class="list-group-item">{{ trans('trans.inStock')}} : {{ $stock == 1 ? 'oui' : 'non'}}</li>
                        @endif
                        @if (!empty($make))
                            <li class="list-group-item">{{ trans('vehicle.make')}} : {{ $make->name}}</li>
                        @endif
                        @if (!empty($modele))
                            <li class="list-group-item">{{ trans('vehicle.model')}} : {{ $modele->name}}</li>
                        @endif
                        @if (!empty($version))
                            <li class="list-group-item">{{ trans('vehicle.version')}} : {{ $version->description.' '.$version->motor}}</li>
                        @endif
                    </ul>
                </div>
            </div>



            <div class="card">
                <form class="form-horizontal" method="POST" action="{{ route('admin.cars.processImport') }}">
                    @csrf
                    @if (empty($version))
                        <div class="card bg-danger w-25 mx-auto p-2 text-center">
                            <input type="checkbox" name="create-title" id="">
                            <label for="">Voulez vous créer le titre</label>
                        </div>
                    @endif
                    <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                    <div class="table-responsive">
                        <table id="parse" class="table table-striped table-bordered table-responsive nowrap" width="100%">
                            <tr>
                                @foreach ($csv_data[0] as $key => $value)
                                    <td>
                                        @if(!empty($version))
                                        <div class="form-group">
                                        {{-- Pour que les options se sélectionne
                                            {{ strtolower($header) === strtolower($fillable) ? 'selected' : '' }} --}}
                                            <select class="form-control select2" name="fields[{{ $key }}]" style="width: auto">
                                                <option value='null'>{{ trans('trans.null') }}</option>
                                                <option value='ref'>{{ trans('vehicle.vin') }}</option>
                                                <option value='label'>{{ trans('vehicle.title') }}</option>
                                                <option value='note_public'>{{ trans('vehicle.notePublic') }}</option>
                                                <option value='note'>{{ trans('vehicle.notePrivee') }}</option>
                                                <option value='price'>{{ trans('vehicle.price') }}</option>
                                                <option value='price_ttc'>{{ trans('vehicle.price_ttc') }}</option>
                                                <option value='cost_price'>{{ trans('vehicle.pa') }}</option>
                                                <option value='comseller'>{{ trans('trans.comseller') }}</option>
                                                <option value='idv'>{{ trans('vehicle.idv') }}</option>
                                                <option value='plates'>{{ trans('vehicle.plates') }}</option>
                                                <option value='mec'>{{ trans('vehicle.mec') }}</option>
                                                <option value='kms'>{{ trans('vehicle.kms') }}</option>
                                                <option value='color'>{{ trans('vehicle.color') }}</option>
                                                <option value='code_color'>{{ trans('vehicle.code_color') }}</option>
                                                <option value='interior'>{{ trans('vehicle.interior') }}</option>
                                                <option value='features'>{{ trans('vehicle.features') }}</option>
                                                <option value='code_option'>{{ trans('vehicle.code-option') }}</option>
                                                <option value='dispoPlace'>{{ trans('vehicle.dispoPlace') }}</option>
                                                <option value='frevo'>{{ trans('vehicle.frevo') }}</option>
                                                <option value='real_frevo'>{{ trans('vehicle.frevoReal') }}</option>
                                                <option value='link_frevo'>{{ trans('vehicle.frevoLink') }}</option>
                                            </select>
                                            @elseif(!empty($make) && !empty($modele) && empty($version))
                                            <select class="form-control select2" name="fields[{{ $key }}]" style="width: auto">
                                                <option value='null'>{{ trans('trans.null') }}</option>
                                                <option value='ref'>{{ trans('vehicle.vin') }}</option>
                                                <option value='label'>{{ trans('vehicle.title') }}</option>
                                                <option value='note_public'>{{ trans('vehicle.notePublic') }}</option>
                                                <option value='note'>{{ trans('vehicle.notePrivee') }}</option>
                                                <option value='price'>{{ trans('vehicle.price') }}</option>
                                                <option value='price_ttc'>{{ trans('vehicle.price_ttc') }}</option>
                                                <option value='cost_price'>{{ trans('vehicle.pa') }}</option>
                                                <option value='comseller'>{{ trans('trans.comseller') }}</option>
                                                <option value='idv'>{{ trans('vehicle.idv') }}</option>
                                                <option value='version'>{{ trans('vehicle.version') }}</option>
                                                <option value='motor'>{{ trans('vehicle.motor') }}</option>
                                                <option value='plates'>{{ trans('vehicle.plates') }}</option>
                                                <option value='mec'>{{ trans('vehicle.mec') }}</option>
                                                <option value='kms'>{{ trans('vehicle.kms') }}</option>
                                                <option value='color'>{{ trans('vehicle.color') }}</option>
                                                <option value='code_color'>{{ trans('vehicle.code_color') }}</option>
                                                <option value='interior'>{{ trans('vehicle.interior') }}</option>
                                                <option value='energy'>{{ trans('vehicle.energy') }}</option>
                                                <option value='gear'>{{ trans('vehicle.boite') }}</option>
                                                <option value='co2'>{{ trans('vehicle.co2') }}</option>
                                                <option value='serie'>{{ trans('vehicle.serie') }}</option>
                                                <option value='features'>{{ trans('vehicle.features') }}</option>
                                                <option value='code_option'>{{ trans('vehicle.code-option') }}</option>
                                                <option value='dispoPlace'>{{ trans('vehicle.dispoPlace') }}</option>
                                                <option value='frevo'>{{ trans('vehicle.frevo') }}</option>
                                                <option value='real_frevo'>{{ trans('vehicle.frevoReal') }}</option>
                                                <option value='link_frevo'>{{ trans('vehicle.frevoLink') }}</option>
                                            </select>
                                            @elseif(!empty($make) && empty($modele) && empty($version))
                                            <select class="form-control select2" name="fields[{{ $key }}]" style="width: auto">
                                                <option value='null'>{{ trans('trans.null') }}</option>
                                                <option value='ref'>{{ trans('vehicle.vin') }}</option>
                                                <option value='label'>{{ trans('vehicle.title') }}</option>
                                                <option value='note_public'>{{ trans('vehicle.notePublic') }}</option>
                                                <option value='note'>{{ trans('vehicle.notePrivee') }}</option>
                                                <option value='price'>{{ trans('vehicle.price') }}</option>
                                                <option value='price_ttc'>{{ trans('vehicle.price_ttc') }}</option>
                                                <option value='cost_price'>{{ trans('vehicle.pa') }}</option>
                                                <option value='comseller'>{{ trans('trans.comseller') }}</option>
                                                <option value='idv'>{{ trans('vehicle.idv') }}</option>
                                                <option value='modele'>{{ trans('vehicle.modele') }}</option>
                                                <option value='version'>{{ trans('vehicle.version') }}</option>
                                                <option value='plates'>{{ trans('vehicle.plates') }}</option>
                                                <option value='mec'>{{ trans('vehicle.mec') }}</option>
                                                <option value='kms'>{{ trans('vehicle.kms') }}</option>
                                                <option value='color'>{{ trans('vehicle.color') }}</option>
                                                <option value='code_color'>{{ trans('vehicle.code_color') }}</option>
                                                <option value='interior'>{{ trans('vehicle.interior') }}</option>
                                                <option value='energy'>{{ trans('vehicle.energy') }}</option>
                                                <option value='gear'>{{ trans('vehicle.boite') }}</option>
                                                <option value='co2'>{{ trans('vehicle.co2') }}</option>
                                                <option value='serie'>{{ trans('vehicle.serie') }}</option>
                                                <option value='features'>{{ trans('vehicle.features') }}</option>
                                                <option value='code_option'>{{ trans('vehicle.code-option') }}</option>
                                                <option value='dispoPlace'>{{ trans('vehicle.dispoPlace') }}</option>
                                                <option value='frevo'>{{ trans('vehicle.frevo') }}</option>
                                                <option value='real_frevo'>{{ trans('vehicle.frevoReal') }}</option>
                                                <option value='link_frevo'>{{ trans('vehicle.frevoLink') }}</option>
                                            </select>
                                            @else
                                            <select name="fields[{{ $key }}]">
                                                <option value='null'>{{ trans('trans.null') }}</option>
                                                <option value='ref' >{{ trans('vehicle.vin') }}</option>
                                                <option value='label'>{{ trans('vehicle.title') }}</option>
                                                <option value='note_public'>{{ trans('vehicle.notePublic') }}</option>
                                                <option value='note'>{{ trans('vehicle.notePrivee') }}</option>
                                                <option value='price'>{{ trans('vehicle.price') }}</option>
                                                <option value='price_ttc'>{{ trans('vehicle.price_ttc') }}</option>
                                                <option value='cost_price'>{{ trans('vehicle.pa') }}</option>
                                                <option value='comseller'>{{ trans('trans.comseller') }}</option>
                                                <option value='idv'>{{ trans('vehicle.idv') }}</option>
                                                <option value='make'>{{ trans('vehicle.make') }}</option>
                                                <option value='modele'>{{ trans('vehicle.modele') }}</option>
                                                <option value='version'>{{ trans('vehicle.version') }}</option>
                                                <option value='motor'>{{ trans('vehicle.motor') }}</option>
                                                <option value='plates'>{{ trans('vehicle.plates') }}</option>
                                                <option value='mec'>{{ trans('vehicle.mec') }}</option>
                                                <option value='kms'>{{ trans('vehicle.kms') }}</option>
                                                <option value='color'>{{ trans('vehicle.color') }}</option>
                                                <option value='code_color'>{{ trans('vehicle.code_color') }}</option>
                                                <option value='interior'>{{ trans('vehicle.interior') }}</option>
                                                <option value='energy'>{{ trans('vehicle.energy') }}</option>
                                                <option value='gear'>{{ trans('vehicle.boite') }}</option>
                                                <option value='co2'>{{ trans('vehicle.co2') }}</option>
                                                <option value='serie'>{{ trans('vehicle.serie') }}</option>
                                                <option value='features'>{{ trans('vehicle.features') }}</option>
                                                <option value='code_option'>{{ trans('vehicle.code-option') }}</option>
                                                <option value='dispoPlace'>{{ trans('vehicle.dispoPlace') }}</option>
                                                <option value='frevo'>{{ trans('vehicle.frevo') }}</option>
                                                <option value='real_frevo'>{{ trans('vehicle.frevoReal') }}</option>
                                                <option value='link_frevo'>{{ trans('vehicle.frevoLink') }}</option>
                                            </select>
                                        </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($csv_header_fields as $csv_header_field)
                                    <th>{{ $csv_header_field }}</th>
                                @endforeach
                            </tr>
                            @foreach ($csv_data as $row)
                            <tr>
                                @foreach ($row as $key => $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-success">
                            {{ trans('trans.importData') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
