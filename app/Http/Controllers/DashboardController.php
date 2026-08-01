<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $service) {}

    public function index(Request $request)
    {
        $rekap = $this->service->getRekap();
        return view('dashboard.index', [
            'grafikPenjualan' => $rekap['grafik'],
            'totalPenjualan' => $rekap['total_penjualan'],
            'jumlahTransaksi' => $rekap['jumlah_transaksi'],
            'barangTerlaris' => $rekap['barang_terlaris'],
        ]);
    }
}
