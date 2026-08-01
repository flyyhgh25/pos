<div class="grid grid-cols-1 gap-4 max-w-xl m-auto p-5">
    <div>
        <x-input-label for="nama_barang" :value="__('Nama Barang')" />
        <x-text-input id="nama_barang" name="nama_barang" type="text" class="mt-1 block w-full" :value="old('nama_barang', $barang->nama_barang ?? '')" required autofocus autocomplete="nama_barang" />
        <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
    </div>
    <div>
        <x-input-label for="tanggal_expired" :value="__('Tanggal Expired')" />
        <x-text-input id="tanggal_expired" name="tanggal_expired" type="date" class="mt-1 block w-full" :value="old('tanggal_expired', optional($barang->tanggal_expired ?? '')->format('Y-m-d'))" required autofocus autocomplete="tanggal_expired" />
        <x-input-error class="mt-2" :messages="$errors->get('tanggal_expired')" />
    </div>
    <div>
        <x-input-label for="stock" :value="__('Stock')" />
        <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $barang->stock ?? 0)" required autofocus autocomplete="stock" />
        <x-input-error class="mt-2" :messages="$errors->get('stock')" />
    </div>
    <div>
        <x-input-label for="harga" :value="__('Harga')" />
        <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" :value="old('harga', $barang->harga ?? '0')" required autofocus autocomplete="harga" />
        <x-input-error class="mt-2" :messages="$errors->get('harga')" />
    </div>
    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</div>