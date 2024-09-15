<div x-data="{ isOpen: false }" class=" bg-white shadow-lg">
    <header class="container mx-auto max-w-full ">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <!-- Logo and Toggle Button -->
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5">
                    <span class="sr-only">Gubug Eyup</span>
                    <img class="h-12 w-auto" src="logo.png" alt="">
                </a>
            </div>
            <!-- Mobile Toggle Button -->
            <div class="flex lg:hidden md:block">
                <button type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                    @click="isOpen = !isOpen">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <!-- Desktop Menu -->
            <div class="hidden lg:flex lg:gap-x-14">
                <!-- Menu Items -->
                <a href="/#homepage" class="text-sm font-semibold leading-6 text-gray-900">Beranda</a>
                <a href="/#catalog" class="text-sm font-semibold leading-6 text-gray-900">Katalog</a>
                <a href="/booking" class="text-sm font-semibold leading-6 text-gray-900">Pemesanan</a>
                <a href="/#gallery" class="text-sm font-semibold leading-6 text-gray-900">Galeri</a>
                <a href="/#contact" class="text-sm font-semibold leading-6 text-gray-900">Kontak</a>
            </div>
        </nav>

        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" role="dialog" aria-modal="true" x-show="isOpen" @click.away="isOpen = false">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <div class="fixed inset-0 z-50">
                <div
                    class="fixed inset-y-0 right-0 z-50 w-1/2 bg-white shadow my-3 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-right justify-between">
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700 ml-auto"
                            @click="isOpen = false">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d=" M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Menu Items -->
                    <div class="mt-6">
                        <div class="space-y-2">
                            <a @click="isOpen = false" href="/#homepage"
                                class="block px-4 py-2 text-base font-semibold leading-5 text-gray-900 hover:bg-gray-50">Beranda</a>
                            <a @click="isOpen = false" href="/#catalog"
                                class="block px-4 py-2 text-base font-semibold leading-5 text-gray-900 hover:bg-gray-50">Katalog</a>
                            <a @click="isOpen = false" href="/booking"
                                class="block px-4 py-2 text-base font-semibold leading-5 text-gray-900 hover:bg-gray-50">Pemesanan</a>
                            <a @click="isOpen = false" href="/#gallery"
                                class="block px-4 py-2 text-base font-semibold leading-5 text-gray-900 hover:bg-gray-50">Galeri</a>
                            <a @click="isOpen = false" href="/#contact"
                                class="block px-4 py-2 text-base font-semibold leading-5 text-gray-900 hover:bg-gray-50">Kontak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
