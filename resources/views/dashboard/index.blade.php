<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="p-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-6">
            <div class="rounded-lg border border-slate-200 bg-white p-5">
                <p class="text-sm text-slate-500">Total Penjualan</p>
                <p class="mt-1 text-2xl font-semibold text-slate-800">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-5">
                <p class="text-sm text-slate-500">Jumlah Transaksi</p>
                <p class="mt-1 text-2xl font-semibold text-slate-800">{{ $jumlahTransaksi }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 rounded-lg border border-slate-200 bg-white p-5">
                <p class="mb-3 text-sm font-medium text-slate-600">Rekap Penjualan Harian</p>
                <canvas id="grafikPenjualan" height="110"></canvas>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-5">
                <p class="mb-3 text-sm font-medium text-slate-600">Barang Terlaris</p>
                @forelse ($barangTerlaris as $item)
                <div class="flex items-center justify-between border-b border-slate-100 py-2 text-sm last:border-0">
                    <span class="text-slate-700">{{ $item->barang->nama_barang ?? 'Barang dihapus' }}</span>
                    <span class="text-slate-500">{{ $item->total_qty }} terjual</span>
                </div>
                @empty
                <p class="text-sm text-slate-400">Belum ada penjualan pada rentang ini.</p>
                @endforelse
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <script>
        const ctx = document.getElementById('grafikPenjualan');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($grafikPenjualan->pluck('tanggal')
                ->map(fn ($tanggal) => \Carbon\Carbon::parse($tanggal)->format('Y-m-d'))),
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: @json($grafikPenjualan->pluck('total')),
                    borderColor: '#2f6f5e',
                    backgroundColor: 'rgba(47, 111, 94, 0.1)',
                    tension: 0.3,
                    fill: true,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: (value) => 'Rp ' + Number(value).toLocaleString('id-ID'),
                        },
                    },
                },
            },
        });
    </script>
    @endpush
</x-app-layout>