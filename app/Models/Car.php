<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Car extends Model implements HasMedia
{
    use MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'cars';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'mec',
        'last_price_update',
        'dispo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'vin',
        'plates',
        'idv',
        'name',
        'make',
        'modele',
        'motor',
        'color',
        'serie',
        'feature',
        'warehouse',
        'import_key',
    ];

    protected $fillable = [
        'user_id',
        'entity_id',
        'seller_id',
        'country',
        'vin',
        'plates',
        'idv',
        'name',
        'description',
        'private_note',
        'code_model_id',
        'make',
        'modele',
        'version_id',
        'motor',
        'ch',
        'co_2',
        'energy',
        'gear',
        'conso',
        'mec',
        'kms',
        'color',
        'interior',
        'serie',
        'feature',
        'price_new',
        'frevo',
        'real_frevo',
        'link_frevo',
        'discount',
        'price_ht',
        'price_ttc',
        'tax',
        'last_price_update',
        'cost_price',
        'impuesto',
        'active',
        'qty',
        'draft',
        'dispo',
        'warehouse',
        'comseller',
        'import_key',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function vehicleShippLines()
    {
        return $this->hasMany(ShippLine::class, 'vehicle_id', 'id');
    }

    public function vehicleOrderLines()
    {
        return $this->hasMany(OrderLine::class, 'vehicle_id', 'id');
    }

    public function vehicleProformaLines()
    {
        return $this->hasMany(ProformaLine::class, 'vehicle_id', 'id');
    }

    public function vehicleInvoiceLines()
    {
        return $this->hasMany(InvoiceLine::class, 'vehicle_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function seller()
    {
        return $this->belongsTo(Company::class, 'seller_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function code_model()
    {
        return $this->belongsTo(CodeModel::class, 'code_model_id');
    }

    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }

    public function getImageAttribute()
    {
        $files = $this->getMedia('image');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getMecAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMecAttribute($value)
    {
        $this->attributes['mec'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getLastPriceUpdateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setLastPriceUpdateAttribute($value)
    {
        $this->attributes['last_price_update'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDispoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDispoAttribute($value)
    {
        $this->attributes['dispo'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
