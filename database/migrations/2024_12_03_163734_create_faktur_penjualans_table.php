<?php

use App\Models\Karyawan;
use App\Models\Obat;
use App\Models\Pelanggan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faktur_penjualans', function (Blueprint $table) {
            $table->id('no');
            $table->date('tanggal');
            $table->foreignIdFor(Pelanggan::class);
            $table->foreignIdFor(Karyawan::class);
            $table->foreignIdFor(Obat::class);
            $table->integer('jumlah'); // Jumlah obat yang dibeli
            $table->integer('total'); // Total harga sebelum pajak
            $table->decimal('pajak', 8, 2); // Pajak yang dikenakan
            $table->decimal('total_bayar', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur_penjualans');
    }
};
