<?php

namespace App\Services;

use App\Models\Barang;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangService
{
    public function paginate(int $item, ?string $search = null): LengthAwarePaginator
    {
        return Barang::query()
            ->when($search, function ($query) use ($search) {
                $query->where('kode_barang', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%");
            })
            ->latest()->paginate($item)->withQueryString();
    }

    public function store(array $data): Barang
    {
        return DB::transaction(function () use ($data) {
            $barang = Barang::create([
                'kode_barang' => $this->generateKodeBarang(),
                'nama_barang' => $data['nama_barang'],
                'tanggal_expired' => $data['tanggal_expired'],
                'stock' => $data['stock'],
                'harga' => $data['harga']
            ]);
            return $barang;
        });
    }

    public function update(int $id, array $data): Barang
    {
        return DB::transaction(function () use ($id, $data) {
            $barang = Barang::findOrFail($id);
            $barang->update([
                'nama_barang' => $data['nama_barang'],
                'tanggal_expired' => $data['tanggal_expired'],
                'stock' => $data['stock'],
                'harga' => $data['harga']
            ]);
            return $barang;
        });
    }

    public function generateKodeBarang(): string
    {
        return 'BRG-' . random_int(1000, 9999);
    }

    public function delete(Barang $barang): void
    {
        $barang->delete();
    }
}
