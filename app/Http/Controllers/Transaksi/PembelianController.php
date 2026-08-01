<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Services\PembelianService;
use Illuminate\Http\Request;

class PembelianController extends Controller
{

    public function __construct(protected PembelianService $service) {}
    public function index()
    {
        $pembelians = $this->service->paginate(10);
        return view('pembelians.index', compact('pembelians'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('nama')->get();
        $barangs = Barang::orderBy('nama_barang')->get();
        return view('pembelians.create', compact('suppliers', 'barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'supplier_id' => ['required', 'string', 'exists:suppliers,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.barang_id' => ['required', 'exists:barangs,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.harga_satuan' => ['required', 'integer', 'min:0']
        ]);
        $this->service->store($validated, $request->user());
        return redirect()->route('pembelians.index')->with('success', 'Transaksi pembelian berhasil disimpan.');
    }

    public function show(Pembelian $pembelian)
    {
        $pembelian->load('details.barang', 'supplier', 'user');
        return view('pembelians.show', compact('pembelian'));
    }
}
