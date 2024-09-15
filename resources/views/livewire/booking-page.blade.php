<div x-data="{ isdetailItem: false, isdetailDecoration: false, selectedItem: null }">
    <div :class="{ 'blur-sm': isdetailItem || isdetailDecoration }" class="bg-white py-14" id="service">
        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Pesan Sekarang</h2>
        <div class="flex flex-col md:flex-row">
            <div class="md:w-3/4 m-2">
                {{-- Dekorasi --}}
                <div class="mt-10">
                    <h2 class="text-2xl font-semibold text-gray-700">Dekorasi</h2>
                    <div class="mx-auto mt-3 grid grid-cols-1 gap-8 lg:grid-cols-3">
                        @foreach ($decorations as $decoration)
                            <article class="flex flex-col shadow my-4">
                                <a class="hover:opacity-75">
                                    @if (!empty($decoration->image))
                                        <img src="{{ asset('storage/' . $decoration->image[0]) }}"
                                            alt="{{ $decoration->name }}" class="w-full h-48 object-cover">
                                    @endif
                                </a>
                                <div class="bg-white flex flex-col justify-between p-6 h-full">
                                    <h3 class="text-xl font-bold">{{ $decoration->name }}</h3>
                                    <p class="text-gray-600 text-sm">{{ Str::limit($decoration->description, 100) }}</p>
                                    <p class="text-gray-900 font-semibold">Harga: Rp.
                                        {{ number_format($decoration->price, 0, ',', '.') }}</p>
                                    <button type="button"
                                        @click="selectedItem = {{ $decoration }}; isdetailDecoration = true"
                                        class="font-medium text-yellow-600 hover:underline text-left">Lihat Detail
                                        &raquo;</button>
                                    <button type="button"
                                        class="mt-4 py-2.5 px-5 text-sm font-medium text-white bg-yellow-700 hover:bg-yellow-800 rounded-lg"
                                        wire:click="addToCart({{ $decoration->id }})">Masukkan Keranjang</button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                {{-- Item Lainnya --}}
                <div class="mt-10">
                    <h2 class="text-2xl font-semibold text-gray-700">Item Lainnya</h2>
                    <div class="mx-auto mt-3 grid grid-cols-1 gap-8 lg:grid-cols-3">
                        @foreach ($additionalItems as $additionalItem)
                            <article class="flex flex-col shadow my-4">
                                <a class="hover:opacity-75">
                                    @if (!empty($additionalItem->image))
                                        <img src="{{ asset('storage/' . $additionalItem->image[0]) }}"
                                            alt="{{ $additionalItem->name }}" class="w-full h-48 object-cover">
                                    @endif
                                </a>
                                <div class="bg-white flex flex-col justify-between p-6 h-full">
                                    <h3 class="text-xl font-bold">{{ $additionalItem->name }}</h3>
                                    <p class="text-gray-600 text-sm">
                                        {{ Str::limit($additionalItem->description, 100) }}</p>
                                    <p class="text-gray-900 font-semibold">Harga: Rp.
                                        {{ number_format($additionalItem->price, 0, ',', '.') }}</p>
                                    <button type="button"
                                        @click="selectedItem = {{ $additionalItem }}; isdetailItem = true"
                                        class="font-medium text-yellow-600 hover:underline text-left">
                                        Lihat Detail &raquo;
                                    </button>
                                    <button type="button"
                                        class="mt-4 py-2.5 px-5 ms-3 text-sm font-medium text-white bg-yellow-700 hover:bg-yellow-800 rounded-lg"
                                        wire:click="addToCart({{ $additionalItem->id }})">
                                        Masukkan Keranjang
                                    </button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="md:w-1/4 mx-10 mt-10">
                <form wire:submit.prevent="submitForm">
                    <h2 class="text-2xl font-semibold text-gray-700 py-10">Pesan Sekarang</h2>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Keranjang</label>
                        <table class="min-w-full border-collapse border border-gray-300 mb-2">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-900">
                                        Nama Barang</th>
                                    <th
                                        class="border border-gray-300 px-4 py-2 text-center text-sm font-medium text-gray-900">
                                        Qty</th>
                                    <th
                                        class="border border-gray-300 px-4 py-2 text-right text-sm font-medium text-gray-900">
                                        Harga</th>
                                    <th
                                        class="border border-gray-300 px-4 py-2 text-center text-sm font-medium text-gray-900">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-900">
                                            {{ $item['name'] }}</td>

                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <div class="inline-flex items-center space-x-2">
                                                <button type="button"
                                                    wire:click="decreaseQuantity({{ $item['id'] }})"
                                                    class="px-2 py-1 border border-gray-500 text-gray-500 rounded-lg">-</button>
                                                <span class="text-sm text-gray-900">{{ $item['quantity'] }}</span>
                                                <button type="button"
                                                    wire:click="increaseQuantity({{ $item['id'] }})"
                                                    class="px-2 py-1 border border-gray-500 text-gray-500 rounded-lg">+</button>
                                            </div>
                                        </td>

                                        <td class="border border-gray-300 px-4 py-2 text-right text-sm text-gray-900">
                                            Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </td>

                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <button type="button" wire:click="removeFromCart({{ $item['id'] }})"
                                                class="px-3 py-1 border border-red-500 text-red-500 rounded-lg hover:bg-red-100 text-sm">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Total Harga</label>
                            <p class="text-md font-semibold text-gray-900">Rp.
                                {{ number_format($grandTotal, 0, ',', '.') }}</p>
                        </div>
                        @if (session()->has('error'))
                            <div class="mb-5">
                                <p class="text-red-500">{{ session('error') }}</p>
                            </div>
                        @endif
                    </div>


                    <!-- Form Fields -->
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Tanggal Pemesanan</label>
                        <input type="text" id="date" wire:model="date"
                            class="bg-gray-50 border border-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="Pilih tanggal yang tersedia" required wire:ignore />
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Nama Anda</label>
                        <input type="text" id="name" wire:model="name"
                            class="bg-gray-50 border border-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="Nama Anda" required />
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                        <textarea id="address" wire:model="address"
                            class="bg-gray-50 border border-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Alamat Anda" required></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Lokasi Pernikahan</label>
                        <textarea id="weddingLocation" wire:model="weddingLocation"
                            class="bg-gray-50 border border-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Lokasi pernikahan Anda"
                            required></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Catatan</label>
                        <textarea id="note" wire:model="note"
                            class="bg-gray-50 border border-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Catatan tambahan"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit"
                            class="text-white bg-yellow-700 hover:bg-yellow-800 font-medium rounded-lg text-sm px-5 py-2.5">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Dekorasi --}}
    <div x-show="isdetailDecoration" @click.away="isdetailDecoration = false"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900" x-text="selectedItem.name"></h3>
                <button @click="isdetailDecoration = false" type="button"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 flex items-center justify-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 space-y-4">
                <div class="flex justify-center space-x-4">
                    <template x-if="selectedItem.image">
                        <template x-for="image in selectedItem.image">
                            <a href="#" class="hover:opacity-75" @click.prevent="openModal(image)">
                                <img :src="'/storage/' + image" :alt="selectedItem.name"
                                    class="w-32 h-32 object-cover mb-2 cursor-pointer">
                            </a>
                        </template>
                    </template>
                </div>
                <p class="text-base leading-relaxed text-gray-500" x-text="selectedItem.description"></p>
                <p class="text-base leading-relaxed text-gray-500">Harga: <span
                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(selectedItem.price)"></span>
                </p>
            </div>
        </div>
    </div>

    {{-- Modal Item --}}
    <div x-show="isdetailItem" @click.away="isdetailItem = false"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900" x-text="selectedItem.name"></h3>
                <button @click="isdetailItem = false" type="button"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 flex items-center justify-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 space-y-4">
                <div class="flex justify-center space-x-4">
                    <template x-if="selectedItem.image">
                        <template x-for="image in selectedItem.image">
                            <a href="#" class="hover:opacity-75" @click.prevent="openModal(image)">
                                <img :src="'/storage/' + image" :alt="selectedItem.name"
                                    class="w-32 h-32 object-cover mb-2 cursor-pointer">
                            </a>
                        </template>
                    </template>
                </div>
                <p class="text-base leading-relaxed text-gray-500" x-text="selectedItem.description"></p>
                <p class="text-base leading-relaxed text-gray-500">Harga: <span
                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(selectedItem.price)"></span>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initializeDatepicker() {
            var disabledDates = @json($disableDates);

            $('#date').datepicker({
                dateFormat: 'yy-mm-dd',
                beforeShowDay: function(date) {
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [disabledDates.indexOf(string) === -1];
                },
                onSelect: function(dateText) {
                    @this.updateDate(dateText);
                }
            });
        }

        // Initialize datepicker on page load
        initializeDatepicker();

        // Reinitialize datepicker after Livewire updates
        Livewire.hook('message.processed', (message, component) => {
            initializeDatepicker();
        });
    });
</script>
