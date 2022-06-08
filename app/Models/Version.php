<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Version extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'versions';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const GEAR_RADIO = [
        'bvm' => 'Boite manuelle',
        'bva' => 'Boite automatique',
    ];

    const ENERGY_SELECT = [
        'Essence'    => 'Essence',
        'Diesel'     => 'Diesel',
        'Electrique' => 'Electrique',
        'Gaz'        => 'Gaz',
        'Hybride'    => 'Hybride',
    ];

    protected $fillable = [
        'description',
        'slug',
        'motor',
        'equipment',
        'kw',
        'ch',
        'co_2',
        'energy',
        'gear',
        'conso',
        'prix',
        'make_id',
        'modele_id',
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

    public function versionCars()
    {
        return $this->hasMany(Car::class, 'version_id', 'id');
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

    public function make()
    {
        return $this->belongsTo(Make::class, 'make_id');
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class, 'modele_id');
    }
}
