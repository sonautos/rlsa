@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.truck.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trucks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.id') }}
                        </th>
                        <td>
                            {{ $truck->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.supplier') }}
                        </th>
                        <td>
                            {{ $truck->supplier->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.plates') }}
                        </th>
                        <td>
                            {{ $truck->plates }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.chauffeur') }}
                        </th>
                        <td>
                            {{ $truck->chauffeur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.price') }}
                        </th>
                        <td>
                            {{ $truck->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.date_load') }}
                        </th>
                        <td>
                            {{ $truck->date_load }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.date_cmr') }}
                        </th>
                        <td>
                            {{ $truck->date_cmr }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.status') }}
                        </th>
                        <td>
                            {{ $truck->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.paid') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $truck->paid ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.user') }}
                        </th>
                        <td>
                            {{ $truck->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.shippment') }}
                        </th>
                        <td>
                            {{ $truck->shippment->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.truck.fields.cmr') }}
                        </th>
                        <td>
                            @if($truck->cmr)
                                <a href="{{ $truck->cmr->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trucks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection