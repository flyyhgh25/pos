<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl  leading-tight">
                {{ __('Menambahkan Supplier') }}
            </h2>
            <x-primary-button>
                <a href="{{route('suppliers.index')}}">
                    {{__('Kembali')}}
                </a>
            </x-primary-button>
        </div>
    </x-slot>
    <form method="POST" action="{{ route('suppliers.store') }}">
        @csrf
        @include('suppliers._form')
    </form>
</x-app-layout>