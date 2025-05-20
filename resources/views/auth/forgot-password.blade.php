<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 m-0 p-0 overflow-hidden">
    <div class="flex h-screen w-screen">
        <!-- Kiri: Form -->
        <div class="w-1/2 flex items-center justify-center bg-white px-16">
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-2 text-left">Forgot Password</h2>
                <p class="text-sm text-gray-600 mb-6 text-left">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>

                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600 text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required autofocus :value="old('email')"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[003E93] focus:border-[003E93]" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-left">
                        <button type="submit"
                            class="px-4 py-2 rounded-md transition text-white"
                            style="background-color: #003E93;"
                            onmouseover="this.style.backgroundColor='#002F74'"
                            onmouseout="this.style.backgroundColor='#003E93'">
                            Email Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kanan: Gambar -->
        <div class="w-1/2 h-full bg-white flex items-center justify-center">
            <img src="{{ asset('build/assets/forgot-password.png') }}" alt="Forgot Password Image" class="object-cover w-3/4 h-3/4">
        </div>
    </div>
</body>
</html>
