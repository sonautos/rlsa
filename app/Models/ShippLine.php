<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ShippLine extends Model
{
    use MultiTenantModelTrait, HasFactory;

    public $table = 'shipp_lines';

    protected $dates = [
        'cmr_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'seller_id',
        'client_id',
        'modele',
        'vehicle_id',
        'vin',
        'color',
        'plates',
        'loading_place',
        'delivery_place',
        'cmr_date',
        'status_id',
        'price',
        'paid',
        'shippment_id',
        'user_id',
        'order_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function seller()
    {
        return $this->belongsTo(Company::class, 'seller_id');
    }

    public function client()
    {
        return $this->belongsTo(Company::class, 'client_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Car::class, 'vehicle_id');
    }

    public function getCmrDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCmrDateAttribute($value)
    {
        $this->attributes['cmr_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function status()
    {
        return $this->belongsTo(ShippStatus::class, 'status_id');
    }

    public function shippment()
    {
        return $this->belongsTo(Shippmentslist::class, 'shippment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(OrdersList::class, 'order_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
