<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Register</title>
    <style>
        .password-eye {
            cursor: pointer;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            padding: 0.5rem;
        }

        .password-eye button {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            font-size: 1rem;
        }

        .password-eye button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                alt="Your Company">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create a new account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2 relative">
                        <input id="password" name="password" type="password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <div class="password-eye">
                            <button type="button" id="toggle-password" aria-label="Toggle password visibility">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12.5V12m-6 0v.5M10 15l-1.5-1.5M14.5 15L13 13.5m-1.5-6l1.5 1.5M12 10l1.5 1.5M10 8l-1.5-1.5M12 4.5V6M6.8 6.8a8.99 8.99 0 0 1 0 10.4m9.6-10.4a8.99 8.99 0 0 1 0 10.4M4.5 12a8.97 8.97 0 0 1 2.6-6.6M15 12a8.97 8.97 0 0 1-2.6 6.6m0-10.4a8.97 8.97 0 0 1 2.6 6.6" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm
                        Password</label>
                    <div class="mt-2 relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <div class="password-eye">
                            <button type="button" id="toggle-password-confirm" aria-label="Toggle password visibility">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12.5V12m-6 0v.5M10 15l-1.5-1.5M14.5 15L13 13.5m-1.5-6l1.5 1.5M12 10l1.5 1.5M10 8l-1.5-1.5M12 4.5V6M6.8 6.8a8.99 8.99 0 0 1 0 10.4m9.6-10.4a8.99 8.99 0 0 1 0 10.4M4.5 12a8.97 8.97 0 0 1 2.6-6.6M15 12a8.97 8.97 0 0 1-2.6 6.6m0-10.4a8.97 8.97 0 0 1 2.6 6.6" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already a member?
                <a href="{{ route('login') }}"
                    class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordButton = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const togglePasswordConfirmButton = document.getElementById('toggle-password-confirm');
            const passwordConfirmInput = document.getElementById('password_confirmation');

            togglePasswordButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('text-gray-400');
                this.classList.toggle('text-indigo-600');
            });

            togglePasswordConfirmButton.addEventListener('click', function() {
                const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmInput.setAttribute('type', type);
                this.classList.toggle('text-gray-400');
                this.classList.toggle('text-indigo-600');
            });
        });
    </script>
</body>

</html>
