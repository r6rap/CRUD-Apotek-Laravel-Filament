<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturPenjualan extends Model
{
    use HasFactory;

    protected $table = 'faktur_penjualans';

    protected $primaryKey = 'no';

    protected $fillable = [
        'no',
        'tanggal',
        'id_pelanggan',
        'id_karyawan',
        'id_obat',
        'jumlah',
        'total',
        'pajak',
        'total_bayar',
    ];

    public function pelanggan():BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function karyawan():BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function obat():BelongsTo
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
