<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFinancePackage extends Model
{
    protected $table = 'school_finance_packages';
    protected $fillable = [
        'school_id', 
        'name', 
        'monthly_cost', 
        'packages', 
        'description', 
        'status_cashback', 
        'status_tax', 
        'selected_at'
    ];

    // Definisi relasi dengan School
     public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
    public function schoolFinancePackages()
    {
        return $this->hasMany(SchoolFinancePackage::class, 'school_finance_package_id', 'id');
    }
}