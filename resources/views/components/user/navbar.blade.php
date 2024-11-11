<nav x-data="{ isOpen: false }" class="bg-blue-400 shadow-lg sticky top-0 z-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <div class="flex items-center flex-grow">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="{{ asset('storage/sipaduu.png') }}" alt="Your Company">
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-6 justify-center">
                        <a href="#stat"
                            class="text-white hover:bg-gray-700 hover:text-white rounded-md px-4 py-2 text-lg font-medium transition duration-300">STATISTIK</a>
                        <a href="#sop"
                            class="text-white hover:bg-gray-700 hover:text-white rounded-md px-4 py-2 text-lg font-medium transition duration-300">SOP</a>
                        <a href="#form"
                            class="text-white hover:bg-gray-700 hover:text-white rounded-md px-4 py-2 text-lg font-medium transition duration-300">PENGADUAN</a>
                        <a href="#kontak"
                            class="text-white hover:bg-gray-700 hover:text-white rounded-md px-4 py-2 text-lg font-medium transition duration-300">KONTAK</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <button type="button"
                        class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-300">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <button type="button" @click="isOpen = !isOpen"
                            class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-300"
                            aria-expanded="false" aria-haspopup="true">
                            <img class="h-7 w-7 rounded-full" src="{{ asset('storage/sipaduu.png') }}" alt="">
                        </button>

                        <div x-show="isOpen" x-transition:enter="transition ease-out duration-150 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100 transform"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <a href="/profile-pengadu"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Your
                                Profile</a>

                            <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                @csrf
                                <button type="submit">Sign out</button>
                            </form>                                
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <button @click="isOpen = !isOpen" type="button"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-300"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <a href="#stat"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white transition">STATISTIK</a>
            <a href="#sop"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white transition">SOP</a>
            <a href="#form"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white transition">PENGADUAN</a>
            <a href="#kontak"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white transition">KONTAK</a>
        </div>
    </div>
</nav>
