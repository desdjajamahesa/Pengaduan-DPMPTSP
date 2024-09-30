<footer class="bg-gradient-to-r flex justify-center from-gray-900 to-gray-800 text-white py-12" id="kontak">
    <div class="container
    mx-autopx-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center md:text-left">
                <h2 class="text-3xl font-bold mb-4">DPMPTSP</h2>
                <p class="text-gray-400 text-sm">
                    Melayani dengan sepenuh hati untuk kemajuan bersama.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    @foreach (['stat' => 'Statistik', 'sop' => 'SOP', 'form' => 'Pengaduan', 'kontak' => 'Kontak'] as $link => $text)
                        <li>
                            <a href="#{{ $link }}" class="hover:text-green-400 transition duration-300">
                                {{ $text }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Hubungi Kami</h3>
                <div class="space-y-3">
                    @php
                        $contacts = App\Models\ContactOption::all();
                    @endphp
                    @foreach ($contacts as $contact)
                        @php
                            $icon = '';
                            $link = '#';
                            $textColor = 'text-gray-300';

                            switch ($contact->type) {
                                case 'whatsapp':
                                    $icon =
                                        '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>';
                                    $link = "https://wa.me/{$contact->value}";
                                    $textColor = 'text-green-400';
                                    break;
                                case 'email':
                                    $icon =
                                        '<path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>';
                                    $link = "mailto:{$contact->value}";
                                    $textColor = 'text-blue-400';
                                    break;
                                case 'phone':
                                    $icon =
                                        '<path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>';
                                    $link = "tel:{$contact->value}";
                                    $textColor = 'text-yellow-400';
                                    break;
                                case 'instagram':
                                    $icon =
                                        '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>';
                                    $link = "https://www.instagram.com/{$contact->value}";
                                    $textColor = 'text-purple-400';
                                    break;
                            }
                        @endphp
                        <a href="{{ $link }}"
                            class="flex items-center space-x-3 {{ $textColor }} hover:text-white transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                {!! $icon !!}
                            </svg>
                            <span class="text-sm">{{ $contact->value }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="mt-8 pt-8 border-t border-gray-700 text-center">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} DPMPTSP. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
</footer>
