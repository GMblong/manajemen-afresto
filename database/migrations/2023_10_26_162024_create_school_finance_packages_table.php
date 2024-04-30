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
        Schema::create('school_finance_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->references('id')->on('schools');
            $table->string('name'); // Tambahkan kolom "nama_langganan"
            $table->decimal('monthly_cost', 10, 0); // Tambahkan kolom "biaya_bulanan"
            $table->enum('packages', ['Bulanan', 'Siswa']); // Tambahkan kolom "paket_langganan"
            $table->text('description')->nullable(); // Tambahkan kolom "description"
            $table->enum('status_cashback', ['Nominal', 'Persentase', 'Tidak Ada Cashback'])->nullable(); // Tambahkan kolom "paket_langganan"
            $table->enum('status_tax', ['Ditanggung', 'Tidak Ditanggung', NULL])->nullable();
            $table->timestamp('selected_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('school_finance_packages');
    }
};


// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up()
//     {
//         Schema::create('school_finance_packages', function (Blueprint $table) {
//             $table->id();
//             $table->foreignId('school_id')->references('id')->on('schools');
//             $table->foreignId('finance_package_id')->references('id')->on('finance_packages');
//             $table->decimal('cashback', 10, 2)->nullable();
//             $table->timestamp('selected_at')->nullable();
//             $table->timestamps();
//         });
//     }    

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('school_finance_packages');
//     }
// };
