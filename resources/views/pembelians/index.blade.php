<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Riwayat Transaksi Pembelian') }}
            </h2>
            <x-primary-button>
                <a href="{{route('pembelians.create')}}">
                    {{__('+ Transaksi Pembelian')}}
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
                            No Transaksi Pembelian
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Supplier
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
                    @forelse ($pembelians as $pembelian)
                    <tr>
                        <td class="px-4 py-3">{{$loop->iteration}}</td>
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $pembelian->no_transaksi}}</td>
                        <td class="px-4 py-3">{{$pembelian->tanggal->format('d-m-Y')}}</td>
                        <td class="px-4 py-3">{{$pembelian->supplier->nama}}</td>
                        <td class="px-4 py-3">Rp {{number_format($pembelian->total_harga,0,',','.')}}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-3 text-xs">
                                <a href="{{ route('pembelians.show', $pembelian) }}" class="text-brand-600 hover:underline">
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
        <div class="mt-4 flex items-center justify-center">{{ $pembelians->links() }}</div>
    </div>
</x-app-layout>