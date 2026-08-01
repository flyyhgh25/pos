<?php

namespace App\Services;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getRekap(): array
    {
        $grafik = Penjualan::query()
            ->selectRaw('tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $totalPenjualan = Penjualan::sum('total_harga');
        $jumlahTransaksi = Penjualan::count();
        $barangTerlaris = PenjualanDetail::query()
            ->select(
                'barang_id',
                DB::raw('SUM(qty) as total_qty'),
                DB::raw('SUM(subtotal) as total_omzet')
            )
            ->with('barang:id,nama_barang')
            ->groupBy('barang_id')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        return [
            'grafik' => $grafik,
            'total_penjualan' => $totalPenjualan,
            'jumlah_transaksi' => $jumlahTransaksi,
            'barang_terlaris' => $barangTerlaris,
        ];
    }
}
