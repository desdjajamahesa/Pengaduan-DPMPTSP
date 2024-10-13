<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>S!Padu</title>
    <style>
        body{
            background-image: url('bg-textured.png');
        }
    </style>
</head>

<body class="bg-blue-50 flex items-center justify-center min-h-screen">
    <!-- Tailwind CSS setup -->
    <!-- Uncomment and configure Tailwind CSS if needed -->
    <!--
    <html class="h-full bg-white">
    <body class="h-full">
    -->

    <div class="w-full max-w-md p-8 bg-blue-200 rounded-lg shadow-xl">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-14 w-auto" src="sipadu.png" alt="SiPadu DPMPTSP Kota Cimahi">
            <h2 class="mt-7 text-center text-2xl font-bold leading-9 tracking-tight text-slate-600">Masukkan Akun</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm px-1 font-semibold leading-6 text-slate-700">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full h-10 rounded-xl shadow-md border-0 px-3.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:outline-none focus:ring-orange-300 sm:text-md sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm px-1 font-semibold leading-6 text-slate-700">Password</label>
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}"
                                class="font-semibold text-cyan-600 hover:text-cyan-400">Lupa password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full h-10 rounded-xl shadow-md border-0 px-3.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:outline-none focus:ring-orange-300 sm:text-md sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-xl bg-cyan-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-md hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Masuk</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-700">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="font-semibold leading-6 text-cyan-700 hover:text-cyan-500">Daftar Akun</a>
            </p>
        </div>
    </div>

</body>

</html>
