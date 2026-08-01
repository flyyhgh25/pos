<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    /** @use HasFactory<\Database\Factories\BarangFactory> */
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'tanggal_expired',
        'stock',
        'harga'
    ];
    protected $casts = [
        'tanggal_expired' => 'date',
        'stock' => 'integer',
        'harga' => 'integer'
    ];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }
}
