@extends('layouts.admin')

@section('styles')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-6 col-lg-3 mt-3">
            <div class="card bg-gray-50 text-gray-700 hover:bg-indigo-400 hover:text-white rounded shadow-xl py-2 px-2">
                <div class="card-body pb-0">
                    <div class="btn-group float-right">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.contact')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.address')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.company')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.contact')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.address')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.company')}}</a>
                        </div>
                    </div>
                    <div class="">
                        <i class="material-icons">people</i><span class="text-value-lg"> {{ trans('trans.Contacts')}} </span>
                    </div>
                    <div class="float-right">
                        <button type="button" class="bg-indigo-600 text-center rounded p-2 m-1">
                            {{ trans('trans.companies')}}<span class="badge badge-light">{{ $companies->count()}}</span>
                        </button>
                        <button type="button" class="bg-indigo-600 text-center rounded p-2 m-1">
                            {{ trans('trans.contacts')}}<span class="badge badge-light">{{ $contacts->count()}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mt-3">
            <div class="card bg-gray-50 text-gray-700 hover:bg-red-500 hover:text-white rounded shadow-xl py-2 px-2">
                <div class="card-body pb-0">
                    <div class="btn-group float-right">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.contact')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.address')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.company')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.contact')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.address')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.company')}}</a>
                        </div>
                    </div>
                    <div class="float">
                        <i class="material-icons">topic</i><span class="text-value-lg"> {{ trans('trans.orders')}} </span>
                    </div>
                    <div class="float-right">
                        <button type="button" class="bg-red-400 text-center rounded p-2 m-1">
                            {{ trans('trans.orders')}}<span class="badge badge-light">{{ $orders->count()}}</span>
                        </button>
                        <button type="button" class="bg-red-400 text-center rounded p-2 m-1">
                            {{ trans('trans.vehicles')}}<span class="badge badge-light"> {{ $orderlines->count()}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mt-3">
            <div class="card bg-gray-50 text-gray-700 hover:bg-yellow-400 hover:text-white rounded shadow-xl py-2 px-2">
                <div class="card-body pb-0">
                    <div class="btn-group float-right">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.contact')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.address')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.company')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.contact')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.address')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.company')}}</a>
                        </div>
                    </div>
                    <div class="float">
                        <i class="material-icons">text_snippet</i><span class="text-value-lg"> {{ trans('trans.Proformas')}} </span>
                    </div>
                    <div class="float-right">
                        <button type="button" class="bg-yellow-500 text-center rounded p-2 m-1">
                            {{ trans('trans.orders')}}<span class="badge badge-light">{{ $proformas->count()}}</span>
                        </button>
                        <button type="button" class="bg-yellow-500 text-center rounded p-2 m-1">
                            {{ trans('trans.vehicles')}}<span class="badge badge-light">{{ $proformalines->count()}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mt-3">
            <div class="card bg-gray-50 text-gray-700 hover:bg-green-400 hover:text-white rounded shadow-xl py-2 px-2">
                <div class="card-body pb-0">
                    <div class="btn-group float-right">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.contact')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.address')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.add')}} {{trans('trans.company')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.contact')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.address')}}</a>
                            <a class="dropdown-item" href="#">{{trans('trans.list')}} {{trans('trans.company')}}</a>
                        </div>
                    </div>
                    <div class="float">
                        <i class="material-icons">request_quote</i><span class="text-value-lg"> {{ trans('trans.Invoices')}} </span>
                    </div>
                    <div class="float-right">
                        <button type="button" class="bg-green-400 text-center rounded p-2 m-1">
                            {{ trans('trans.orders')}}<span class="badge badge-light">{{ $orders->count()}}</span>
                        </button>
                        <button type="button" class="bg-green-400 text-center rounded p-2 m-1">
                            {{ trans('trans.vehicles')}}<span class="badge badge-light">{{ $orderlines->count()}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="card bg-green-300 text-white hover:bg-green-400 hover:text-white rounded shadow-xl py-5 px-5">
            <div class="text-center">{{ to_money($orders->sum('total_ht'))}} € H.T</div>
            {{-- <div class="text-center">{{ to_money($orderlines->sum('comclient')) }} € H.T commissions clients</div>
            <div class="text-center">
                {{ $orderlines->vehicle->count()}}
                @foreach ($orderlines as $vh)
                    {{$vh->vehicle->comseller}}
                @endforeach
            </div> --}}
        </div>

        <div class="row">
            <div class="{{ $chart1->options['column_class'] }}">
                <h3>{!! $chart1->options['chart_title'] !!}</h3>
                {!! $chart1->renderHtml() !!}
            </div>
            <div class="{{ $chart2->options['column_class'] }}">
                <h3>{!! $chart2->options['chart_title'] !!}</h3>
                {!! $chart2->renderHtml() !!}
            </div>
            <div class="{{ $chart3->options['column_class'] }}">
                <h3>{!! $chart3->options['chart_title'] !!}</h3>
                {!! $chart3->renderHtml() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}{!! $chart3->renderJs() !!}
@endsection
