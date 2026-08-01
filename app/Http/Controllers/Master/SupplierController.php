<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct(protected SupplierService $service) {}

    public function index()
    {
        $suppliers = $this->service->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'pic' => ['required', 'string', 'max:150'],
            'alamat' => ['required', 'string', 'max:250'],
        ]);
        $this->service->store($validate);
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.update', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validate = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'pic' => ['required', 'string', 'max:150'],
            'alamat' => ['required', 'string', 'max:250'],
        ]);
        $this->service->update($supplier->id, $validate);
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diedit!');
    }


    public function destroy(Supplier $supplier)
    {
        $this->service->delete($supplier);
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil hapus!');
    }
}
