@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.make.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.makes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.make.fields.id') }}
                        </th>
                        <td>
                            {{ $make->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.make.fields.name') }}
                        </th>
                        <td>
                            {{ $make->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.make.fields.slug') }}
                        </th>
                        <td>
                            {{ $make->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.makes.index') }}">
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
            <a class="nav-link" href="#make_modeles" role="tab" data-toggle="tab">
                {{ trans('cruds.modele.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="make_modeles">
            @includeIf('admin.makes.relationships.makeModeles', ['modeles' => $make->makeModeles])
        </div>
    </div>
</div>

@endsection