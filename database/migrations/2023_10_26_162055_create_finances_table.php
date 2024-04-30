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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('invoices_number');
            $table->foreignId('school_finance_package_id')->references('id')->on('school_finance_packages');
            $table->date('month');
            $table->decimal('cashback', 10, 0)->nullable();
            $table->decimal('ppn', 10, 0)->nullable();
            $table->decimal('pph', 10, 0);
            $table->decimal('tax', 10, 0);
            $table->decimal('total_payment', 10, 0);
            $table->decimal('income', 10, 0);
            $table->integer('students')->default(0); // Nilai default 0 (atau sesuai nilai yang sesuai)
            $table->foreignId('company_directors_id')->references('id')->on('company_directors');
            $table->enum('status', ['Lunas', 'Belum Lunas'])->nullable();
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
