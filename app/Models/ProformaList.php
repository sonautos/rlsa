<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ProformaList extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'proforma_lists';

    protected $dates = [
        'date_created',
        'date_valid',
        'date_livraison',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ref',
        'entity_id',
        'seller_id',
        'client_id',
        'task_id',
        'date_created',
        'date_valid',
        'author_id',
        'valid_id',
        'user_updated_id',
        'status_id',
        'total_ht',
        'tva',
        'total_ttc',
        'remise',
        'remise_percent',
        'cond_reglement_id',
        'mode_reglement_id',
        'note_private',
        'note_public',
        'date_livraison',
        'shipping_method_id',
        'delivery_address_id',
        'paid',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'bank_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function proformaProformaLines()
    {
        return $this->hasMany(ProformaLine::class, 'proforma_id', 'id');
    }

    public function proformaInvoiceLines()
    {
        return $this->hasMany(InvoiceLine::class, 'proforma_id', 'id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function seller()
    {
        return $this->belongsTo(Company::class, 'seller_id');
    }

    public function client()
    {
        return $this->belongsTo(Company::class, 'client_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function getDateCreatedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateCreatedAttribute($value)
    {
        $this->attributes['date_created'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateValidAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateValidAttribute($value)
    {
        $this->attributes['date_valid'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function valid()
    {
        return $this->belongsTo(User::class, 'valid_id');
    }

    public function user_updated()
    {
        return $this->belongsTo(User::class, 'user_updated_id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function cond_reglement()
    {
        return $this->belongsTo(CondReglement::class, 'cond_reglement_id');
    }

    public function mode_reglement()
    {
        return $this->belongsTo(ModeReglement::class, 'mode_reglement_id');
    }

    public function getDateLivraisonAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateLivraisonAttribute($value)
    {
        $this->attributes['date_livraison'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function shipping_method()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    public function delivery_address()
    {
        return $this->belongsTo(Address::class, 'delivery_address_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
