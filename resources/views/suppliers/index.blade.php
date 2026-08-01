<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl  leading-tight">
                {{ __('Supplier') }}
            </h2>
            <x-primary-button>
                <a href="{{route('suppliers.create')}}">
                    {{__('+ Supplier')}}
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
                            No Supplier
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            PIC
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                    <tr>
                        <td class="px-4 py-3">{{$loop->iteration}}</td>
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $supplier->no_supplier }}</td>
                        <td class="px-4 py-3">{{ $supplier->nama }}</td>
                        <td class="px-4 py-3">{{$supplier->pic}}</td>
                        <td class="px-4 py-3">{{$supplier->alamat}}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-3 text-xs">
                                <a href="{{ route('suppliers.edit', $supplier) }}" class="text-brand-600 hover:underline">Ubah</a>
                                <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}"
                                    onsubmit="return confirm('Hapus supplier{{$supplier->nama}}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500">Hapus</button>
                                </form>
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
        <div class="mt-4 flex items-center justify-center">{{ $suppliers->links() }}</div>
    </div>
</x-app-layout>