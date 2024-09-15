<div>
    <!-- Beranda -->
    <div class="max-w-2xl py-10 mx-auto">
        <!-- Carousel Container -->
        <div class="relative overflow-hidden" id="homepage">
            <!-- Slides -->
            <div class="flex transition-transform duration-700 ease-out" id="slides">
                @foreach ($catalogs as $catalog)
                    <div class="min-w-full">
                        <img src="{{ asset('storage/' . $catalog->image[0]) }}" alt="{{ $catalog->name }}"
                            class="w-full h-80 object-cover rounded-lg">
                        <div class="text-center py-4 bg-white">
                            <h3 class="text-lg font-bold text-gray-800">{{ $catalog->name }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Controls -->
            <button id="prevBtn"
                class="absolute top-1/2 left-4 -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75">&#10094;</button>
            <button id="nextBtn"
                class="absolute top-1/2 right-4 -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75">&#10095;</button>

            <!-- Indicators -->
            <div id="indicators" class="absolute bottom-1 left-1/2 -translate-x-1/2 flex space-x-2">
                @foreach ($catalogs as $index => $catalog)
                    <button class="w-3 h-3 bg-white rounded-full hover:bg-gray-300 border border-gray-400"
                        data-slide="{{ $index }}"></button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Katalog -->
    <div class="bg-white py-12" id="catalog">
        <h2 class="text-3xl font-bold text-gray-900">Katalog</h2>
        <div class="mt-10">
            <h2 class="text-2xl font-semibold text-gray-700">Dekorasi</h2>

            <div
                class="mx-auto mt-3 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-1 pt-1 sm:mt-3 sm:pt-1 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach ($decorations->take(3) as $decoration)
                    <article class="flex flex-col shadow my-4">
                        <a class="hover:opacity-75">
                            @if (!empty($decoration->image))
                                <img src="{{ asset('storage/' . $decoration->image[0]) }}" alt="{{ $decoration->name }}"
                                    class="w-full h-48 object-cover">
                            @endif
                        </a>
                        <div class="bg-white flex flex-col justify-between p-6">
                            <h3 class="text-xl font-bold">{{ $decoration->name }}</h3>
                            <p class="text-sm text-gray-600">{{ Str::limit($decoration->description, 100) }}</p>
                            <p class="text-gray-900 font-semibold">Harga: Rp.
                                {{ number_format($decoration->price, 0, ',', '.') }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-2xl font-semibold text-gray-700">Item Lainnya</h2>
            <div
                class="mx-auto mt-3 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-1 pt-1 sm:mt-3 sm:pt-1 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach ($additionalItems->take(3) as $additionalItem)
                    <article class="flex flex-col shadow my-4">
                        <a class="hover:opacity-75">
                            @if (!empty($additionalItem->image))
                                <img src="{{ asset('storage/' . $additionalItem->image[0]) }}"
                                    alt="{{ $additionalItem->name }}" class="w-full h-48 object-cover">
                            @endif
                        </a>
                        <div class="bg-white flex flex-col justify-between p-6">
                            <h3 class="text-xl font-bold">{{ $additionalItem->name }}</h3>
                            <p class="text-sm text-gray-600">{{ Str::limit($additionalItem->description, 100) }}</p>
                            <p class="text-gray-900 font-semibold">Harga: Rp.
                                {{ number_format($additionalItem->price, 0, ',', '.') }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-6" id="booking">
        <a href="/booking" class="bg-yellow-700 text-white font-bold text-sm rounded hover:bg-yellow-800 px-4 py-3">
            Lihat Semua Layanan dan Pesan Sekarang
        </a>
    </div>

    <!-- Galeri -->
    <div class="bg-white py-12 " id="gallery">
        <h2 class="text-3xl font-bold text-gray-900">Galeri</h2>
        <div class="mx-auto mt-10 grid max-w-4xl grid-cols-3 gap-3">
            @foreach ($catalogs as $catalog)
                <img src="{{ asset('storage/' . $catalog->image[0]) }}" alt="{{ $catalog->name }}"
                    class="w-full h-48 object-cover hover:opacity-75">
            @endforeach
        </div>
    </div>

    <!-- Kontak -->
    <div class="bg-yellow-50 dark:bg-yellow-900 py-10" id="contact">
        <div class="mb-6 max-w-3xl text-center mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Kontak</h2>
        </div>
        <div class="flex items-stretch justify-center mx-auto mt-5 max-w-2xl">
            <div class="grid md:grid-cols-2">
                <div class="p-10">
                    <p class="mt-3 mb-5 text-lg text-slate-400 dark:text-slate-100">Kami hadir untuk membuat momen
                        spesial Anda lebih sempurna</p>
                    <ul>
                        <li class="flex mb-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded bg-yellow-700 text-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                    <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    <path
                                        d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Alamat</h3>
                                <p class="text-slate-400 dark:text-slate-100">Jagalan, Salam, Magelang, Jawa Tengah
                                    56484</p>
                            </div>
                        </li>
                        <li class="flex mb-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded bg-yellow-700 text-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                    <path
                                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                                    </path>
                                    <path d="M15 7a2 2 0 0 1 2 2"></path>
                                    <path d="M15 3a6 6 0 0 1 6 6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Kontak</h3>
                                <p class="text-slate-400 dark:text-slate-100">Telp: +6281391228688</p>
                                <p class="text-slate-400 dark:text-slate-100">Email: gubugeyup@gmail.com</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="p-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.3353253854993!2d110.31204987372314!3d-7.647044075647252!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af53165a1a227%3A0xfde7bad5e9b49728!2sGubug%20Eyup%20Dekorasi!5e0!3m2!1sen!2sid!4v1725211423318!5m2!1sen!2sid"
                        width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelector('#slides');
        const slideCount = slides.children.length;
        const prevBtn = document.querySelector('#prevBtn');
        const nextBtn = document.querySelector('#nextBtn');
        const indicators = document.querySelectorAll('#indicators button');
        let currentIndex = 0;
        let autoSlideInterval;

        function showSlide(index) {
            if (index < 0) currentIndex = slideCount - 1;
            else if (index >= slideCount) currentIndex = 0;
            else currentIndex = index;

            slides.style.transform = `translateX(-${currentIndex * 100}%)`;
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('bg-gray-800', i === currentIndex);
                indicator.classList.toggle('bg-white', i !== currentIndex);
            });
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        prevBtn.addEventListener('click', () => {
            prevSlide();
            stopAutoSlide();
            startAutoSlide();
        });

        nextBtn.addEventListener('click', () => {
            nextSlide();
            stopAutoSlide();
            startAutoSlide();
        });

        indicators.forEach((indicator, i) => {
            indicator.addEventListener('click', () => {
                showSlide(i);
                stopAutoSlide();
                startAutoSlide();
            });
        });

        showSlide(currentIndex);
        startAutoSlide();
    });
</script>
