<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('headmaster_name');
            $table->string('office_phone')->nullable(); // Tambahkan kolom "telp kantor"
            $table->string('phone_number')->nullable(); // Nomor telepon
            $table->string('email')->nullable(); // Email
            $table->string('url')->nullable()->unique();
            $table->enum('city', [
                'Semarang', 
                'Kudus', 
                'Yogyakarta', 
                'Jakarta',
                'Surabaya',
                'Bali',
                'Bandung',
                'Bekasi',
                'Pekanbaru',
            ])->nullable();
            $table->enum('status', ['Berlangganan', 'Proses SPK', 'Putus Kontrak', 'Selesai'])->default('Proses SPK');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
};
