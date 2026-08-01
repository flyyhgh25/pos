<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Transaksi Penjualan') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-6 grid grid-cols-1 gap-4"
        x-data="penjualanForm(@js($barangs
                ->map(fn($b) => [
                    'id' => $b->id,
                    'nama' => $b->nama_barang,
                    'harga' => $b->harga,
                    'stock' => $b->stock,
                ])))">
        <form method="POST"
            action="{{ route('penjualans.store') }}"
            @submit="beforeSubmit($event)"
            class="flex flex-col gap-4">
            @csrf
            <div>
                <x-input-label for="tanggal" :value="__('Tanggal')" />
                <x-text-input
                    id="tanggal"
                    name="tanggal"
                    type="date"
                    class="rounded-md"
                    :value="old('tanggal', now()->toDateString())"
                    required autofocus autocomplete="tanggal" />
                <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
            </div>

            <div class="overflow-hidden rounded-lg border bg-white">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Barang</th>
                            <th class="p-3 w-28">Qty</th>
                            <th class="p-3 w-40">Subtotal</th>
                            <th class="p-3 w-12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item,index) in items" :key="index">
                            <tr class="border-t">
                                <td class="p-3">
                                    <select
                                        class="w-full rounded border-gray-300"
                                        :name="`items[${index}][barang_id]`"
                                        x-model.number="item.barang_id">
                                        <option value="">
                                            Pilih Barang
                                        </option>
                                        <template
                                            x-for="barang in barangs"
                                            :key="barang.id">
                                            <option
                                                :value="barang.id"
                                                x-text="`${barang.nama} (stok : ${barang.stock})`">
                                            </option>
                                        </template>
                                    </select>
                                </td>
                                <td class="p-3">
                                    <input
                                        type="number"
                                        min="1"
                                        class="w-full rounded border-gray-300"
                                        :name="`items[${index}][qty]`"
                                        x-model.number="item.qty">
                                </td>
                                <td class="p-3">
                                    <span
                                        x-text="formatRupiah(subtotal(item))">
                                    </span>
                                </td>
                                <td class="p-3">
                                    <button
                                        type="button"
                                        @click="removeItem(index)"
                                        class="text-red-600">
                                        x
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div class="p-4 border-t">
                    <button
                        type="button"
                        @click="addItem()"
                        class="text-blue-600">
                        + Tambah Barang
                    </button>
                </div>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <h3 class="font-semibold">
                    Total :
                    <span x-text="formatRupiah(grandTotal())"></span>
                </h3>
                <div class="space-x-2">
                    <a href="{{ route('penjualans.index') }}" class="px-4 py-2 border rounded">
                        Batal
                    </a>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function penjualanForm(barangs) {
            return {
                barangs,
                items: [{
                    barang_id: '',
                    qty: 1
                }],
                addItem() {
                    this.items.push({
                        barang_id: '',
                        qty: 1
                    });
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                },
                getBarang(id) {
                    return this.barangs.find(b => b.id === id);
                },
                subtotal(item) {
                    let barang = this.getBarang(item.barang_id);
                    return barang ? barang.harga * item.qty : 0;
                },
                grandTotal() {
                    return this.items.reduce((total, item) => {
                        return total + this.subtotal(item);
                    }, 0);
                },
                formatRupiah(value) {
                    return new Intl.NumberFormat(
                        'id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }
                    ).format(value);
                },

                beforeSubmit(e) {
                    if (this.items.length === 0) {
                        alert('Minimal 1 barang.');
                        e.preventDefault();
                        return;
                    }

                    for (let item of this.items) {
                        let barang = this.getBarang(item.barang_id);
                        if (!barang) {
                            alert('Pilih barang.');
                            e.preventDefault();
                            return;
                        }
                        if (item.qty < 1) {
                            alert('Qty minimal 1');
                            e.preventDefault();
                            return;
                        }
                        if (item.qty > barang.stock) {
                            alert(
                                `Stok ${barang.nama} hanya ${barang.stock}`
                            );
                            e.preventDefault();
                            return;
                        }
                    }
                }
            }
        }
    </script>
    @endpush
</x-app-layout>