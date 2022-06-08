<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'company_id',
        'individual_id',
        'name',
        'iban',
        'swift',
    ];

    public function entity()
    {
        return $this->hasOne(OrdersList::class, 'bank_id', 'id');
    }
    public function company()
    {
        return $this->hasOne(OrdersList::class, 'bank_id', 'id');
    }
    public function individual()
    {
        return $this->hasOne(OrdersList::class, 'bank_id', 'id');
    }
    
    public function orders()
    {
        return $this->hasMany(OrdersList::class, 'bank_id');
    }
    public function proformas()
    {
        return $this->hasMany(OrdersList::class, 'bank_id');
    }
}
