<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Detail Riwayat Transaksi Penjualan') }}
            </h2>
            <x-primary-button>
                <a href="{{route('penjualans.index')}}">
                    {{__('Kembali')}}
                </a>
            </x-primary-button>
        </div>
    </x-slot>
    <div class="p-8">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">No. Transaksi</p>
                <p class="text-lg font-semibold text-slate-800">{{ $penjualan->no_transaksi }}</p>
            </div>
            <div class="text-right text-sm text-slate-500">
                <p>{{ $penjualan->tanggal->format('d M Y') }}</p>
                <p>Kasir: {{ $penjualan->user->name }}</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-4 py-2.5">Barang</th>
                        <th class="px-4 py-2.5">Qty</th>
                        <th class="px-4 py-2.5">Harga Satuan</th>
                        <th class="px-4 py-2.5">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($penjualan->details as $detail)
                    <tr>
                        <td class="px-4 py-2.5">{{ $detail->barang->nama_barang }}</td>
                        <td class="px-4 py-2.5">{{ $detail->qty }}</td>
                        <td class="px-4 py-2.5">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td class="px-4 py-2.5">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-slate-50 font-medium">
                        <td colspan="3" class="px-4 py-2.5 text-right">Total</td>
                        <td class="px-4 py-2.5">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>