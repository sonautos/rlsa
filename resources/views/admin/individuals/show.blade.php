@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.individual.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.individuals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.id') }}
                        </th>
                        <td>
                            {{ $individual->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.societe') }}
                        </th>
                        <td>
                            {{ $individual->societe->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.entity') }}
                        </th>
                        <td>
                            {{ $individual->entity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.civility') }}
                        </th>
                        <td>
                            {{ App\Models\Individual::CIVILITY_RADIO[$individual->civility] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.firstname') }}
                        </th>
                        <td>
                            {{ $individual->firstname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.lastname') }}
                        </th>
                        <td>
                            {{ $individual->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.address') }}
                        </th>
                        <td>
                            {{ $individual->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.address_2') }}
                        </th>
                        <td>
                            {{ $individual->address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.zip') }}
                        </th>
                        <td>
                            {{ $individual->zip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.city') }}
                        </th>
                        <td>
                            {{ $individual->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.state') }}
                        </th>
                        <td>
                            {{ $individual->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.country') }}
                        </th>
                        <td>
                            {{ $individual->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.poste') }}
                        </th>
                        <td>
                            {{ $individual->poste }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.phone') }}
                        </th>
                        <td>
                            {{ $individual->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.mobile') }}
                        </th>
                        <td>
                            {{ $individual->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.email') }}
                        </th>
                        <td>
                            {{ $individual->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.user_create') }}
                        </th>
                        <td>
                            {{ $individual->user_create->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.user_modif') }}
                        </th>
                        <td>
                            {{ $individual->user_modif->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.note_private') }}
                        </th>
                        <td>
                            {{ $individual->note_private }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.note_public') }}
                        </th>
                        <td>
                            {{ $individual->note_public }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.photo') }}
                        </th>
                        <td>
                            @if($individual->photo)
                                <a href="{{ $individual->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $individual->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.tags') }}
                        </th>
                        <td>
                            @foreach($individual->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->tag }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.latitude') }}
                        </th>
                        <td>
                            {{ $individual->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.longitude') }}
                        </th>
                        <td>
                            {{ $individual->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.url_place') }}
                        </th>
                        <td>
                            {{ $individual->url_place }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.individuals.index') }}">
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
            <a class="nav-link" href="#individual_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="individual_addresses">
            @includeIf('admin.individuals.relationships.individualAddresses', ['addresses' => $individual->individualAddresses])
        </div>
    </div>
</div>

@endsection