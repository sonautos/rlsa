<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Individual;
use App\Models\OrderLine;
use App\Models\OrdersList;
use App\Models\ProformaLine;
use App\Models\ProformaList;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {

        $companies = Company::all();
        $contacts = Individual::all();
        $orders = OrdersList::with('orderShippLines', 'orderOrderLines')->get();
        $orderlines = OrderLine::with('order', 'product', 'service', 'vehicle', 'status')->get();
        $proformas = ProformaList::with('proformaProformaLines', 'proformaInvoiceLines')->get();
        $proformalines = ProformaLine::with('proforma', 'product', 'service', 'vehicle', 'status')->get();

        $settings1 = [
            'chart_title'           => 'Orders',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\OrdersList',
            'group_by_field'        => 'date_created',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'total_ht',
            'filter_field'          => 'date_created',
            'filter_days'           => '120',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'Commissions Clients',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\OrderLine',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'comclient',
            'filter_field'          => 'created_at',
            'filter_days'           => '90',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'           => 'Commissions Vendeurs',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\OrderLine',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'vehicle.comseller',
            'filter_field'          => 'created_at',
            'filter_days'           => '90',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $chart3 = new LaravelChart($settings3);

        return view('home', compact('chart1', 'chart2', 'chart3', 'companies', 'contacts', 'orders', 'orderlines', 'proformas', 'proformalines'));
    }
}
