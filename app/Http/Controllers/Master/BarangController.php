<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Services\BarangService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function __construct(protected BarangService $service) {}

    public function index(Request $request)
    {
        $barangs = $this->service->paginate(10, $request->search);
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        return view('barangs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => ['required', 'string', 'max:150'],
            'tanggal_expired' => ['nullable', 'date'],
            'stock' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'integer', 'min:0'],
        ]);
        $this->service->store($validated);
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Barang $barang)
    {
        return view('barangs.update', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => ['required', 'string', 'max:150'],
            'tanggal_expired' => ['nullable', 'date'],
            'stock' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'integer', 'min:0'],
        ]);
        $this->service->update($barang->id, $validated);
        return redirect()->route('barangs.index')->with('success', 'Barang Berhasil ditampilkan!');
    }

    public function destroy(Barang $barang)
    {
        $this->service->delete($barang);
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    }
}
