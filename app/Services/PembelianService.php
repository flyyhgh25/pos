<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PembelianService
{
    public function paginate(int $item): LengthAwarePaginator
    {
        return Pembelian::query()->latest()->paginate($item);
    }

    public function store(array $data, User $user)
    {
        return DB::transaction(function () use ($data, $user) {
            $totalHarga = 0;
            $itemsAdded = [];

            foreach ($data['items'] as $item) {
                // Ambil data barang berdasarkan ID
                $barang = Barang::lockForUpdate()->findOrFail($item['barang_id']);
                $subtotal = $barang->harga * $item['qty'];
                $totalHarga += $subtotal;
                $itemsAdded[] = [
                    'barang' => $barang,
                    'qty' => $item['qty'],
                    'harga_satuan' => $barang->harga,
                    'subtotal' => $subtotal,
                ];
            }
            $pembelian = Pembelian::create([
                'no_transaksi' => $this->generateNoTransaksi(),
                'tanggal' => $data['tanggal'],
                'supplier_id' => $data['supplier_id'],
                'total_harga' => $totalHarga,
                'user_id' => $user->id
            ]);

            foreach ($itemsAdded as $item) {
                $pembelian->details()->create([
                    'barang_id' => $item['barang']->id,
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);
                $item['barang']->increment('stock', $item['qty']);
            }
            return $pembelian;
        });
    }

    private function generateNoTransaksi()
    {
        return 'TRX-PB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
    }
}
