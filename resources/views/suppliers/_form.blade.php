<div class="grid grid-cols-1 gap-4 max-w-xl m-auto p-5">
    <div>
        <x-input-label for="Nama" :value="__('Nama Perusahaan')" />
        <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $supplier->nama ?? '')" required autofocus autocomplete="nama" />
        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
    </div>
    <div>
        <x-input-label for="pic" :value="__('PIC')" />
        <x-text-input id="pic" name="pic" type="text" class="mt-1 block w-full" :value="old('pic', $supplier->pic ?? '')" required autofocus autocomplete="pic" />
        <x-input-error class="mt-2" :messages="$errors->get('pic')" />
    </div>
    <div>
        <x-input-label for="alamat" :value="__('Alamat')" />
        <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat', $supplier->alamat ?? '')" required autofocus autocomplete="alamat" />
        <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
    </div>
    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</div>