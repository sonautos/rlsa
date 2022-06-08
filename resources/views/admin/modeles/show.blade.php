@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.modele.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.modeles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.modele.fields.id') }}
                        </th>
                        <td>
                            {{ $modele->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.modele.fields.name') }}
                        </th>
                        <td>
                            {{ $modele->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.modele.fields.slug') }}
                        </th>
                        <td>
                            {{ $modele->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.modele.fields.make') }}
                        </th>
                        <td>
                            {{ $modele->make->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.modeles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection