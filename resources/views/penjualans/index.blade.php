<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Riwayat Transaksi Penjualan') }}
            </h2>
            <x-primary-button>
                <a href="{{route('penjualans.create')}}">
                    {{__('+ Transaksi Penjualan')}}
                </a>
            </x-primary-button>
        </div>
    </x-slot>
    <div class="p-8">
        <div class="w-full rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="bg-gray-500 border-b border-default text-black">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            No Transaksi Penjualan
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Kasir
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualans as $penjualan)
                    <tr>
                        <td class="px-4 py-3">{{$loop->iteration}}</td>
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $penjualan->no_transaksi}}</td>
                        <td class="px-4 py-3">{{$penjualan->tanggal->format('d M Y')}}</td>
                        <td class="px-4 py-3">{{$penjualan->user->name}}</td>
                        <td class="px-4 py-3">Rp {{number_format($penjualan->total_harga,0,',','.')}}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-3 text-xs">
                                <a href="{{ route('penjualans.show', $penjualan) }}" class="text-brand-600 hover:underline">
                                    Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center">
                            Data Kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex items-center justify-center">{{ $penjualans->links() }}</div>
    </div>
</x-app-layout>