<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CodeModel extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'code_models';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'make_id',
        'modele_id',
        'version_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function codeModelCars()
    {
        return $this->hasMany(Car::class, 'code_model_id', 'id');
    }

    public function make()
    {
        return $this->belongsTo(Make::class, 'make_id');
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class, 'modele_id');
    }

    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }
}
