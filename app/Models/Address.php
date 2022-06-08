<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Address extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'addresses';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'societe_id',
        'entity_id',
        'individual_id',
        'fonction',
        'name',
        'address',
        'address_2',
        'zip',
        'city',
        'state',
        'country',
        'phone',
        'mobile',
        'email',
        'user_create_id',
        'user_modif_id',
        'note_private',
        'note_public',
        'latitude',
        'longitude',
        'url_place',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function societe()
    {
        return $this->belongsTo(Company::class, 'societe_id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }

    public function user_create()
    {
        return $this->belongsTo(User::class, 'user_create_id');
    }

    public function user_modif()
    {
        return $this->belongsTo(User::class, 'user_modif_id');
    }

    public function tags()
    {
        return $this->belongsToMany(TagContact::class);
    }
}
