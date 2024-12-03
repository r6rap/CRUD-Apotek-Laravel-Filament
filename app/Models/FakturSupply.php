<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakturSupply extends Model
{
    use HasFactory;

    protected $table = 'faktur_supplys';

    protected $primaryKey = 'no';

    protected $fillable = [
        'no',
        'tanggal',
        'id_karyawan',
        'id_supplier',
        'id_obat',
        'jumlah_obat',
        'total',
        'pajak',
        'total_bayar',
    ];

    public function karyawan():BelongsTo
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function supplier():BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function obat():BelongsTo
    {
        return $this->belongsTo(Obat::class);
    }
}
