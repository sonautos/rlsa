@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.description') }}
                        </th>
                        <td>
                            {{ $product->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.price') }}
                        </th>
                        <td>
                            {{ $product->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th>
                        <td>
                            @foreach($product->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.tag') }}
                        </th>
                        <td>
                            @foreach($product->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.photo') }}
                        </th>
                        <td>
                            @if($product->photo)
                                <a href="{{ $product->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $product->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
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
            <a class="nav-link" href="#product_order_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.orderLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_proforma_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.proformaLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_invoice_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.invoiceLine.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_order_lines">
            @includeIf('admin.products.relationships.productOrderLines', ['orderLines' => $product->productOrderLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_proforma_lines">
            @includeIf('admin.products.relationships.productProformaLines', ['proformaLines' => $product->productProformaLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_invoice_lines">
            @includeIf('admin.products.relationships.productInvoiceLines', ['invoiceLines' => $product->productInvoiceLines])
        </div>
    </div>
</div>

@endsection