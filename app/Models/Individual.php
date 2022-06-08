<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Individual extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'individuals';

    protected $appends = [
        'photo',
    ];

    public static $searchable = [
        'lastname',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CIVILITY_RADIO = [
        'mr'   => 'MR',
        'mlle' => 'Mlle',
        'mme'  => 'MME',
    ];

    protected $fillable = [
        'societe_id',
        'entity_id',
        'civility',
        'firstname',
        'lastname',
        'address',
        'address_2',
        'zip',
        'city',
        'state',
        'country',
        'poste',
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function individualAddresses()
    {
        return $this->hasMany(Address::class, 'individual_id', 'id');
    }

    public function societe()
    {
        return $this->belongsTo(Company::class, 'societe_id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function user_create()
    {
        return $this->belongsTo(User::class, 'user_create_id');
    }

    public function user_modif()
    {
        return $this->belongsTo(User::class, 'user_modif_id');
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

    public function banks()
    {
        return $this->hasMany(Bank::class, 'individual_id', 'id');
    }
}
