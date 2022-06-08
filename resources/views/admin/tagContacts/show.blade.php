@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tagContact.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tag-contacts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tagContact.fields.id') }}
                        </th>
                        <td>
                            {{ $tagContact->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tagContact.fields.tag') }}
                        </th>
                        <td>
                            {{ $tagContact->tag }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tag-contacts.index') }}">
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
            <a class="nav-link" href="#tags_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.company.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tags_individuals" role="tab" data-toggle="tab">
                {{ trans('cruds.individual.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tags_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tags_companies">
            @includeIf('admin.tagContacts.relationships.tagsCompanies', ['companies' => $tagContact->tagsCompanies])
        </div>
        <div class="tab-pane" role="tabpanel" id="tags_individuals">
            @includeIf('admin.tagContacts.relationships.tagsIndividuals', ['individuals' => $tagContact->tagsIndividuals])
        </div>
        <div class="tab-pane" role="tabpanel" id="tags_addresses">
            @includeIf('admin.tagContacts.relationships.tagsAddresses', ['addresses' => $tagContact->tagsAddresses])
        </div>
    </div>
</div>

@endsection