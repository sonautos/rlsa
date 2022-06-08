<div class="card shadow-lg col-md-6 mx-auto my-2">
    <div class="table pt-3">
        <table class="table table-responsive table-bordered text-center" style="width: 100%">
            <thead>
                <tr>
                    <th>{{ trans('trans.total')}}</th>
                    <th>{{trans('trans.total_cost')}}</th>
                    <th>{{ trans('trans.total_sell') }}</th>
                    <th>{{ trans('trans.total_paid')}}</th>
                    <th>{{ trans('trans.margin') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>{{ trans('trans.shippments')}}</b><span class="badge badge-dark float-right">{{ count($shipps) }}</span></td>
                    <td>{{ to_money($trucks->sum('price')) }} €</td>
                    <td>{{ to_money($shipp_lines->sum('price'))}} €</td>
                    <td>{{ to_money($truck_paid->sum('price')) }} €</td>
                    <td>{{ to_money($shipp_lines->sum('price') - $trucks->sum('price'))}} €</td>
                </tr>
                <tr>
                    <td><b>{{ trans('trans.shippment-det')}}</b><span class="badge badge-dark float-right">{{ count($shipp_lines) }}</span></td>
                    <td>{{ to_money($trucks->sum('price') / count($shipp_lines)) }} €</td>
                    <td>{{ to_money($shipp_lines->sum('price') / count($shipp_lines)) }} €</td>
                    <td>{{ to_money($truck_paid->sum('price') / count($shipp_lines)) }} €</td>
                    <td>{{ to_money(($shipp_lines->sum('price') - $trucks->sum('price')) / count($shipp_lines))}} €</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>