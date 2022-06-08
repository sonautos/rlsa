<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class TagContact extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'tag_contacts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tag',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tagsCompanies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function tagsIndividuals()
    {
        return $this->belongsToMany(Individual::class);
    }

    public function tagsAddresses()
    {
        return $this->belongsToMany(Address::class);
    }
}
