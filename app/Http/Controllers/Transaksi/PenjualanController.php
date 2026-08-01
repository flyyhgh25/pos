<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Services\PenjualanService;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{

    public function __construct(protected PenjualanService $service) {}
    public function index()
    {
        $penjualans = $this->service->paginate(10);
        return view('penjualans.index', compact('penjualans'));
    }

    public function create()
    {
        $barangs = Barang::where('stock', '>', 0)->orderBy('nama_barang')->get();

        return view('penjualans.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.barang_id' => ['required', 'exists:barangs,id'],
            'items.*.qty' => ['required', 'integer', 'min:1']
        ]);
        $this->service->store($validated, $request->user());
        return redirect()->route('penjualans.index')->with('success', 'Transaksi Penjualan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load('details.barang', 'user');
        return view('penjualans.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
