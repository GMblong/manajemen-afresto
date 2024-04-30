<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $table = 'agreements';
    protected $fillable = [
        'start_date',
        'end_date',
        'due_date',
        'notified_at',
        'agreements_number',
        'school_letter_number',
        'school_id',
        'status',
        'agreements_files',
        'company_directors_id',
    ];
    protected $casts = [
        'agreements_files' => 'array', // Ubah sesuai kebutuhan, bisa 'json' jika Anda ingin menyimpannya sebagai JSON
    ];
    
    // Definisi relasi dengan School
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function company_directors()
    {
        return $this->belongsTo(CompanyDirectors::class, 'company_directors_id', 'id');
    }
}
