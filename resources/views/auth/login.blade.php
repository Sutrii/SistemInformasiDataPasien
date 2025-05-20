<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('build/assets/logo.png') }}" type="image/png">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 m-0 p-0 overflow-hidden">
    <div class="flex h-screen w-screen">
        <div class="w-1/2 flex items-center justify-center bg-white px-16">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Login</h2>
                <p class="text-sm text-gray-600 mb-6">Welcome!</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required autofocus
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[003E93] focus:border-[003E93]" />
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[003E93] focus:border-[003E93]" />
                    </div>

                    <div class="mb-4 flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600">Remember me</label>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <button type="submit"
                            class="px-4 py-2 rounded-md transition text-white"
                            style="background-color: #003E93;"
                            onmouseover="this.style.backgroundColor='#002F74'"
                            onmouseout="this.style.backgroundColor='#003E93'">
                            Log in
                        </button>
                    </div>

                    <p class="text-sm text-gray-600 text-center">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register now</a>
                    </p>
                </form>
            </div>
        </div>

        <div class="w-1/2 h-full bg-white flex items-center justify-center">
            <img src="{{ asset('build/assets/bg.png') }}" alt="Login Image" class="object-cover w-3/4 h-3/4">
        </div>
    </div>
</body>
</html>
