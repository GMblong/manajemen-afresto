<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $table = 'finances';
    protected $fillable = [
        'invoices_number', 
        'school_finance_package_id', 
        'month', 
        'cashback', 
        'ppn', 
        'pph', 
        'tax',
        'total_payment', 
        'income', 
        'students',
        'company_directors_id',
        'status',];

    // Definisi relasi dengan SchoolFinancePackage
    public function schoolFinancePackage()
    {
        return $this->belongsTo(SchoolFinancePackage::class, 'school_finance_package_id', 'id');
    }

    public function company_directors()
    {
        return $this->belongsTo(CompanyDirectors::class, 'company_directors_id', 'id');
    }
}