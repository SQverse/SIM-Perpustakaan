<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - HiPerpus</title>
    <!-- Memanggil Tailwind CSS bawaan Laravel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased overflow-hidden bg-white">
    <div class="min-h-screen flex">
        
        <!-- Bagian Kiri: Gambar dan Branding (Hilang saat di layar HP) -->
        <div class="hidden lg:flex lg:w-1/2 bg-blue-700 relative justify-center items-center">
            <!-- Gambar dari Unsplash -->
            <img src="https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-multiply" alt="Library Background">
            <div class="relative z-10 text-center px-12">
                <h1 class="text-6xl font-extrabold text-white tracking-wider mb-4 drop-shadow-lg">HiPerpus</h1>
                <p class="text-xl text-blue-100 font-medium">Sistem Informasi Manajemen Perpustakaan</p>
            </div>
        </div>

        <!-- Bagian Kanan: Form Login -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 sm:p-12 p-8">
            <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
                
                <!-- Logo untuk tampilan HP -->
                <div class="mb-8 lg:hidden text-center">
                    <h1 class="text-4xl font-extrabold text-blue-600 tracking-tight">HiPerpus</h1>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang!</h2>
                    <p class="text-gray-500 text-sm">Silakan masuk dengan akun pustakawan Anda untuk melanjutkan.</p>
                </div>

                <!-- Session Status bawaan Laravel -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                            class="w-full px-5 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full px-5 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Fitur Remember Me & Lupa Password -->
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer">
                            <span class="ms-2 text-sm text-gray-600 font-medium">Ingat Saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-bold text-blue-600 hover:text-blue-500 transition" href="{{ route('password.request') }}">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>

                    <!-- Tombol Login -->
                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-2xl shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 transform hover:-translate-y-1">
                            Masuk ke Sistem
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>