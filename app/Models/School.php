<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $fillable = [
        'name',
        'address',
        'city',
        'phone_number',
        'headmaster_name',
        'status',
        'url',
    ];    

    // Definisi relasi dengan Agreement
    public function agreements()
    {
        return $this->hasMany(Agreement::class, 'school_id', 'id');
    }

    public function schoolFinancePackages()
    {
        return $this->hasMany(SchoolFinancePackage::class, 'school_id', 'id');
    }
}