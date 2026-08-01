<?php

namespace App\Services;

use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SupplierService
{
    public function paginate(int $item): LengthAwarePaginator
    {
        return Supplier::query()->latest()->paginate($item);
    }

    public function store(array $data): Supplier
    {
        return DB::transaction(function () use ($data) {
            $supplier = Supplier::create([
                'no_supplier' => $this->generateKodeSupplier(),
                'nama' => $data['nama'],
                'pic' => $data['pic'],
                'alamat' => $data['alamat'],
            ]);
            return $supplier;
        });
    }

    public function update(int $id, array $data): Supplier
    {
        return DB::transaction(function () use ($id, $data) {
            $supplier = Supplier::findOrFail($id);
            $supplier->update([
                'nama' => $data['nama'],
                'pic' => $data['pic'],
                'alamat' => $data['alamat'],
            ]);
            return $supplier;
        });
    }

    public function generateKodeSupplier(): string
    {
        return 'SUP-' . random_int(1000, 9999);
    }

    public function delete(Supplier $supplier): void
    {
        $supplier->delete($supplier);
    }
}
