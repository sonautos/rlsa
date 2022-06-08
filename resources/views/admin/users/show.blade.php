@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <td>
                            {{ $user->firstname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#user_cars" role="tab" data-toggle="tab">
                {{ trans('cruds.car.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_shippmentslists" role="tab" data-toggle="tab">
                {{ trans('cruds.shippmentslist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_shipp_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.shippLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#author_orders_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.ordersList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#valid_orders_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.ordersList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#author_proforma_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.proformaList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#valid_proforma_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.proformaList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#author_invoices_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.invoicesList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#valid_invoices_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.invoicesList.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_cars">
            @includeIf('admin.users.relationships.userCars', ['cars' => $user->userCars])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_shippmentslists">
            @includeIf('admin.users.relationships.userShippmentslists', ['shippmentslists' => $user->userShippmentslists])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_shipp_lines">
            @includeIf('admin.users.relationships.userShippLines', ['shippLines' => $user->userShippLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="author_orders_lists">
            @includeIf('admin.users.relationships.authorOrdersLists', ['ordersLists' => $user->authorOrdersLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="valid_orders_lists">
            @includeIf('admin.users.relationships.validOrdersLists', ['ordersLists' => $user->validOrdersLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="author_proforma_lists">
            @includeIf('admin.users.relationships.authorProformaLists', ['proformaLists' => $user->authorProformaLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="valid_proforma_lists">
            @includeIf('admin.users.relationships.validProformaLists', ['proformaLists' => $user->validProformaLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="author_invoices_lists">
            @includeIf('admin.users.relationships.authorInvoicesLists', ['invoicesLists' => $user->authorInvoicesLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="valid_invoices_lists">
            @includeIf('admin.users.relationships.validInvoicesLists', ['invoicesLists' => $user->validInvoicesLists])
        </div>
    </div>
</div>

@endsection