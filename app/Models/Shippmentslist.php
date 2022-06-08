<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Shippmentslist extends Model
{
    use MultiTenantModelTrait, HasFactory;

    public $table = 'shippmentslists';

    protected $dates = [
        'date_delivery',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ref',
        'entity_id',
        'status_id',
        'user_id',
        'note_private',
        'note_public',
        'date_delivery',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function shippmentShippLines()
    {
        return $this->hasMany(ShippLine::class, 'shippment_id', 'id');
    }

    public function shippmentTrucks()
    {
        return $this->hasOne(Truck::class, 'shippment_id', 'id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function status()
    {
        return $this->belongsTo(ShippStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDateDeliveryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateDeliveryAttribute($value)
    {
        $this->attributes['date_delivery'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
