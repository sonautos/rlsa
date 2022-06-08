<?php

namespace App\Exports;

use App\Models\Shippment;
use App\Models\Shippmentslist;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ShippDemandExport implements FromView
{
    protected $id;

    function __construct($id) {
           $this->id = $id;
    }

   public function view(): View
    {
        return view('exports.excel.shippment-dets', [
            'shipp' => Shippmentslist::with('shippmentShippLines', 'shippmentTrucks')->findOrFail($this->id)
        ]);
    }
}
