<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'id_obat', 'nama', 'jenis', 'harga', 'stock', 'id_supplier'
    ];

    public function supplier():BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
