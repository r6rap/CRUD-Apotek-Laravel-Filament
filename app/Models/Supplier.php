<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $primaryKey = 'id_supplier';

    protected $fillable = [
        'id_supplier',
        'nama',
        'alamat',
        'kota',
        'no_telp',
    ];

    public function obats()
    {
        return $this->hasMany(Obat::class, 'id_supplier');
    }
}
