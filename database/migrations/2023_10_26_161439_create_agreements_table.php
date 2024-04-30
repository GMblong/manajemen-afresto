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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->references('id')->on('schools');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('due_date');
            $table->timestamp('notified_at')->nullable();
            $table->string('agreements_number');
            $table->string('school_letter_number')->nullable(); // Tambahkan kolom "Nomor surat sekolah"
            $table->enum('status', ['Sudah Perpanjangan', 'Perlu Perpanjangan', NULL])->nullable();
            $table->json('agreements_files')->nullable();
            $table->foreignId('company_directors_id')->references('id')->on('company_directors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('agreements');
    }
};

