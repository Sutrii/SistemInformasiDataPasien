<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="{{ asset('build/assets/logo.png') }}" type="image/png">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 m-0 p-0 overflow-hidden">
    <div class="flex h-screen w-screen">
        <!-- Kiri: Form Register -->
        <div class="w-1/2 flex items-center justify-center bg-white px-16">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Register</h2>
                <p class="text-sm text-gray-600 mb-6">Create your account</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input id="name" name="name" type="text" required autofocus :value="old('name')"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[003E93] focus:border-[003E93]" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required :value="old('email')"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[003E93] focus:border-[003E93]" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[003E93] focus:border-[003E93]" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[003E93] focus:border-[003E93]" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Already registered?</a>
                        <button type="submit"
                            class="px-4 py-2 rounded-md transition text-white"
                            style="background-color: #003E93;"
                            onmouseover="this.style.backgroundColor='#002F74'"
                            onmouseout="this.style.backgroundColor='#003E93'">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kanan: Gambar -->
        <div class="w-1/2 h-full bg-white flex items-center justify-center">
            <img src="{{ asset('build/assets/bg.png') }}" alt="Register Image" class="object-cover w-3/4 h-3/4">
        </div>
    </div>
</body>
</html>
