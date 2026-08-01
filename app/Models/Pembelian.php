<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembelian extends Model
{
    /** @use HasFactory<\Database\Factories\PembelianFactory> */
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'supplier_id',
        'total_harga',
        'user_id'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_harga' => 'integer'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(PembelianDetail::class);
    }
}
