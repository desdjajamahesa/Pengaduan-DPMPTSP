<div class="flex-1 flex flex-col" x-data="{ menuOpen: false }">
    <!-- Header -->
    <header
        class="bg-gradient-to-r from-cyan-500 to-blue-600 shadow-md p-4 flex justify-between items-center border-b border-gray-200 sticky top-0 z-50">
        <!-- Logo and Title -->
        <aside>
            <div class="flex items-center space-x-4">
                <!-- Logo (Jika ada) -->

                <!-- Title -->
                <button @click="menuOpen = !menuOpen" class="lg:hidden text-white p-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-4xl font-bold text-white tracking-wider">S!Padu - Sistem Pengaduan</h1>
            </div>
        </aside>
    </header>

    <!-- Dropdown Menu -->
    <nav x-show="menuOpen" x-transition
        class="bg-white shadow-md border-b border-gray-200 absolute top-16 left-0 w-full lg:hidden z-40">
        <ul class="flex flex-col space-y-2 p-4">
            <li><a href="/super-dashboard"
                    class="flex items-center font-semibold py-3 px-8 rounded-md hover:bg-cyan-600 hover:text-white transition ease-in-out duration-200 w-full">Dashboard</a>
            </li>
            <li><a
                    href="/usersuper"class="flex items-center font-semibold py-3 px-8 rounded-md hover:bg-cyan-600 hover:text-white transition ease-in-out duration-200 w-full">Pelapor</a>
            </li>
            <li><a href="/pengaduansuper"
                    class="flex items-center font-semibold py-3 px-8 rounded-md hover:bg-cyan-600 hover:text-white transition ease-in-out duration-200 w-full">Pengaduan</a>
            </li>
            <li><a
                    href="/sopsuper"class="flex items-center font-semibold py-3 px-8 rounded-md hover:bg-cyan-600 hover:text-white transition ease-in-out duration-200 w-full">SOP</a>
            </li>
            <li><a href="/kontaksuper"
                    class="flex items-center font-semibold py-3 px-8 rounded-md hover:bg-cyan-600 hover:text-white transition ease-in-out duration-200 w-full">Kontak</a>
            </li>
            <li><a href="/adminsuper"
                    class="flex items-center font-semibold py-3 px-8 rounded-md hover:bg-cyan-600 hover:text-white transition ease-in-out duration-200 w-full">Kontak</a>
            </li>
            <li><a href="/profile-super"
                    class="flex items-center font-semibold py-3 px-8 rounded-md hover:bg-cyan-600 hover:text-white transition ease-in-out duration-200 w-full">Profile</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="flex items-center font-semibold py-3 px-8 rounded-md hover:bg-cyan-600 hover:text-white transition ease-in-out duration-200 w-full">

                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <script src="//unpkg.com/alpinejs" defer></script>
