@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.codeModel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.code-models.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.codeModel.fields.id') }}
                        </th>
                        <td>
                            {{ $codeModel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codeModel.fields.code') }}
                        </th>
                        <td>
                            {{ $codeModel->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codeModel.fields.make') }}
                        </th>
                        <td>
                            {{ $codeModel->make->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codeModel.fields.modele') }}
                        </th>
                        <td>
                            {{ $codeModel->modele->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codeModel.fields.version') }}
                        </th>
                        <td>
                            {{ $codeModel->version->description ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.code-models.index') }}">
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
            <a class="nav-link" href="#code_model_cars" role="tab" data-toggle="tab">
                {{ trans('cruds.car.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="code_model_cars">
            @includeIf('admin.codeModels.relationships.codeModelCars', ['cars' => $codeModel->codeModelCars])
        </div>
    </div>
</div>

@endsection