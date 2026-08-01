<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Barang') }}
            </h2>
            <form action="{{route('barangs.index')}}" class="flex gap-2">
                @method('GET')
                <input
                    type="text"
                    name="search"
                    value="{{request('search')}}"
                    placeholder="Cari berdasarkan kode atau nama barang..."
                    class="rounded-md border-gray-300 shadow-sm w-80">
                <x-primary-button>
                    Cari
                </x-primary-button>
                @if(request('search'))
                <a href="{{route('barangs.index')}}"
                    class="px-4 py-2 border rounded-md">
                    Reset
                </a>
                @endif
            </form>
            <x-primary-button>
                <a href="{{route('barangs.create')}}">
                    {{__('+ Barang')}}
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
                            Kode barang
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Tanggal Expired
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Stock
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang)
                    <tr>
                        <td class="px-4 py-3">{{$loop->iteration}}</td>
                        <td class="px-4 py-3 font-medium text-slate-700">{{$barang->kode_barang}}</td>
                        <td class="px-4 py-3">{{$barang->nama_barang}}</td>
                        <td class="px-4 py-3">
                            <span class="text-slate-500">
                                {{$barang->tanggal_expired->format('d-M-Y')}}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="{{ $barang->stock <= 10 ? 'text-red-600 font-medium' : 'text-slate-700' }}">
                                {{$barang->stock}}
                            </span>
                        </td>
                        <td class="px-4 py-3">Rp {{number_format($barang->harga, 0, ',', '.')}}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-3 text-xs">
                                <a href="{{ route('barangs.edit', $barang) }}" class="text-brand-600 hover:underline">Ubah</a>
                                <form method="POST" action="{{ route('barangs.destroy', $barang) }}"
                                    onsubmit="return confirm('Hapus barang {{ $barang->nama_barang }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center">
                            Data Kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex items-center justify-center">{{$barangs->links()}}</div>
    </div>
</x-app-layout>