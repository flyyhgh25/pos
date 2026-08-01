<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class PenjualanService
{
    public function paginate(int $item): LengthAwarePaginator
    {
        return Penjualan::query()->latest()->paginate($item);
    }

    public function store(array $data, User $user): Penjualan
    {
        return DB::transaction(function () use ($data, $user) {
            $totalHarga = 0;
            $itemsAdded = [];
            foreach ($data['items'] as $item) {
                // cek barang dengan stock
                $barang = Barang::lockForUpdate()
                    ->findOrFail($item['barang_id']);
                if ($barang->stock < $item['qty']) {
                    throw ValidationException::withMessages([
                        'items' => "Stock {$barang->nama_barang} tidak mencukupi tersisa {$barang->stock}"
                    ]);
                }
                $subtotal = $barang->harga * $item['qty'];
                $totalHarga += $subtotal;
                $itemsAdded[] = [
                    'barang' => $barang,
                    'qty' => $item['qty'],
                    'harga_satuan' => $barang->harga,
                    'subtotal' => $subtotal
                ];
            }
            $penjualan = Penjualan::create([
                'no_transaksi' => $this->generateNoTransaksi(),
                'tanggal' => $data['tanggal'],
                'total_harga' => $totalHarga,
                'user_id' => $user->id
            ]);

            foreach ($itemsAdded as $item) {
                $penjualan->details()->create([
                    'barang_id' => $item['barang']->id,
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal']
                ]);
                $item['barang']->decrement('stock', $item['qty']);
            }
            return $penjualan;
        });
    }
    private function generateNoTransaksi()
    {
        return 'TRX-PJ-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
    }
}
