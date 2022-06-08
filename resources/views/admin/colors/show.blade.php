@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.color.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.colors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.color.fields.id') }}
                        </th>
                        <td>
                            {{ $color->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.color.fields.name') }}
                        </th>
                        <td>
                            {{ $color->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.color.fields.code') }}
                        </th>
                        <td>
                            {{ $color->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.color.fields.image') }}
                        </th>
                        <td>
                            @if($color->image)
                                <a href="{{ $color->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $color->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.color.fields.url_image') }}
                        </th>
                        <td>
                            {{ $color->url_image }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.color.fields.make') }}
                        </th>
                        <td>
                            {{ $color->make->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.color.fields.modele') }}
                        </th>
                        <td>
                            {{ $color->modele->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.colors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection