@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.version.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.versions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.id') }}
                        </th>
                        <td>
                            {{ $version->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.description') }}
                        </th>
                        <td>
                            {{ $version->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.slug') }}
                        </th>
                        <td>
                            {{ $version->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.motor') }}
                        </th>
                        <td>
                            {{ $version->motor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.equipment') }}
                        </th>
                        <td>
                            {!! $version->equipment !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.kw') }}
                        </th>
                        <td>
                            {{ $version->kw }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.ch') }}
                        </th>
                        <td>
                            {{ $version->ch }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.co_2') }}
                        </th>
                        <td>
                            {{ $version->co_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.energy') }}
                        </th>
                        <td>
                            {{ App\Models\Version::ENERGY_SELECT[$version->energy] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.gear') }}
                        </th>
                        <td>
                            {{ App\Models\Version::GEAR_RADIO[$version->gear] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.conso') }}
                        </th>
                        <td>
                            {{ $version->conso }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.prix') }}
                        </th>
                        <td>
                            {{ $version->prix }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.image') }}
                        </th>
                        <td>
                            @foreach($version->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.make') }}
                        </th>
                        <td>
                            {{ $version->make->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.version.fields.modele') }}
                        </th>
                        <td>
                            {{ $version->modele->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.versions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#version_cars" role="tab" data-toggle="tab">
                {{ trans('cruds.car.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="version_cars">
            @includeIf('admin.versions.relationships.versionCars', ['cars' => $version->versionCars])
        </div>
    </div>
</div>

@endsection