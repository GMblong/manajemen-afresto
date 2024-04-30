<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDirectors extends Model
{
    protected $table = 'company_directors';
    protected $fillable = [
        'name',
        'position',	
        'address',
        'phone',
        'email',
        'signature',
        // Add other fields as needed
    ];


    public function finance()
    {
        return $this->hasMany(Finance::class, 'company_directors_id', 'id');
    }
    public function agreements()
    {
        return $this->hasMany(Agreement::class, 'company_directors_id', 'id');
    }

}
