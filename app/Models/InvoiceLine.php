<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class InvoiceLine extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'invoice_lines';

    public static $searchable = [
        'name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'proforma_id',
        'product_id',
        'service_id',
        'vehicle_id',
        'name',
        'description',
        'qty',
        'tva_tx',
        'remise_percent',
        'remise',
        'total_ht',
        'total_tva',
        'total_ttc',
        'cost_price',
        'comclient',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function proforma()
    {
        return $this->belongsTo(ProformaList::class, 'proforma_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Car::class, 'vehicle_id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
