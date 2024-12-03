<?php

use App\Models\Karyawan;
use App\Models\Obat;
use App\Models\Supplier;
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
        Schema::create('faktur_supplies', function (Blueprint $table) {
            $table->id('no');
            $table->date('tanggal');
            $table->foreignIdFor(Karyawan::class);
            $table->foreignIdFor(Supplier::class);
            $table->foreignIdFor(Obat::class);
            $table->integer('jumlah_obat'); // Jumlah obat yang dibeli
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
        Schema::dropIfExists('faktur_supplies');
    }
};
