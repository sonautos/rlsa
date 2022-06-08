@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.feature.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.features.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.feature.fields.id') }}
                        </th>
                        <td>
                            {{ $feature->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feature.fields.make') }}
                        </th>
                        <td>
                            {{ $feature->make->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feature.fields.modele') }}
                        </th>
                        <td>
                            {{ $feature->modele->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feature.fields.code') }}
                        </th>
                        <td>
                            {{ $feature->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feature.fields.name') }}
                        </th>
                        <td>
                            {{ $feature->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feature.fields.description') }}
                        </th>
                        <td>
                            {!! $feature->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.features.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection