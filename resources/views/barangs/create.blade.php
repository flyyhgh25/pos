<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-center leading-tight">
                {{ __('Menambahkan Barang') }}
            </h2>
            <x-primary-button>
                <a href="{{route('barangs.index')}}">
                    {{__('Kembali')}}
                </a>
            </x-primary-button>
        </div>
    </x-slot>
    <form method="POST" action="{{ route('barangs.store') }}">
        @csrf
        @include('barangs._form')
    </form>
</x-app-layout>