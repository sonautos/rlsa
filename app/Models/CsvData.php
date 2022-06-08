<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvData extends Model
{
    use HasFactory;

    protected $table = 'csv_data';
    protected $fillable = [
        'csv_filename',
        'entity',
        'seller_id',
        'dispo',
        'make_id',
        'modele_id',
        'version_id',
        'increasePrice',
        'qty',
        'comseller',
        'csv_data'
    ];
}
