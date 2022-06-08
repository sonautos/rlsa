<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Entity extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'entities';

    public static $searchable = [
        'name',
        'city',
        'email',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
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
        'latitude',
        'longitude',
        'url_place',
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
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function entityCompanies()
    {
        return $this->hasMany(Company::class, 'entity_id', 'id');
    }

    public function entityIndividuals()
    {
        return $this->hasMany(Individual::class, 'entity_id', 'id');
    }

    public function entityAddresses()
    {
        return $this->hasMany(Address::class, 'entity_id', 'id');
    }

    public function entityShippmentslists()
    {
        return $this->hasMany(Shippmentslist::class, 'entity_id', 'id');
    }

    public function entityOrdersLists()
    {
        return $this->hasMany(OrdersList::class, 'entity_id', 'id');
    }

    public function entityProformaLists()
    {
        return $this->hasMany(ProformaList::class, 'entity_id', 'id');
    }

    public function entityInvoicesLists()
    {
        return $this->hasMany(InvoicesList::class, 'entity_id', 'id');
    }

    public function entityCars()
    {
        return $this->hasMany(Car::class, 'entity_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function entityBanks()
    {
        return $this->hasMany(Bank::class, 'entity_id', 'id');
    }
}
