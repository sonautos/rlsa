<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Company extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'companies';

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'name',
        'alias',
        'city',
        'email',
    ];

    protected $fillable = [
        'entity_id',
        'name',
        'alias',
        'supplier',
        'status',
        'parent',
        'code_client',
        'code_supplier',
        'address',
        'address_2',
        'zip',
        'city',
        'state',
        'country',
        'phone',
        'email',
        'siren',
        'siret',
        'ape',
        'vatnumber',
        'capital',
        'note_private',
        'note_public',
        'active',
        'latitude',
        'longitude',
        'url_place',
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

    public function societeIndividuals()
    {
        return $this->hasMany(Individual::class, 'societe_id', 'id');
    }

    public function societeAddresses()
    {
        return $this->hasMany(Address::class, 'societe_id', 'id');
    }

    public function sellerShippLines()
    {
        return $this->hasMany(ShippLine::class, 'seller_id', 'id');
    }

    public function clientShippLines()
    {
        return $this->hasMany(ShippLine::class, 'client_id', 'id');
    }

    public function supplierTrucks()
    {
        return $this->hasMany(Truck::class, 'supplier_id', 'id');
    }

    public function sellerCars()
    {
        return $this->hasMany(Car::class, 'seller_id', 'id');
    }

    public function clientOrdersLists()
    {
        return $this->hasMany(OrdersList::class, 'client_id', 'id');
    }

    public function clientProformaLists()
    {
        return $this->hasMany(ProformaList::class, 'client_id', 'id');
    }

    public function sellerOrdersLists()
    {
        return $this->hasMany(OrdersList::class, 'seller_id', 'id');
    }

    public function sellerProformaLists()
    {
        return $this->hasMany(ProformaList::class, 'seller_id', 'id');
    }

    public function sellerInvoicesLists()
    {
        return $this->hasMany(InvoicesList::class, 'seller_id', 'id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function tags()
    {
        return $this->belongsToMany(TagContact::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function companyBanks()
    {
        return $this->hasMany(Bank::class, 'company_id', 'id');
    }
}
