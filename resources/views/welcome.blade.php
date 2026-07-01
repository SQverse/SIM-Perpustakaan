<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HiPerpus - Selamat Datang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased overflow-hidden bg-white">
    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 bg-blue-700 relative justify-center items-center">
            <img src="https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-multiply" alt="Library Background">
            <div class="relative z-10 text-center px-12">
                <h1 class="text-6xl font-extrabold text-white tracking-wider mb-4 drop-shadow-lg">HiPerpus</h1>
                <p class="text-xl text-blue-100 font-medium">Sistem Informasi Manajemen Perpustakaan Modern.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 p-8">
            <div class="w-full max-w-sm text-center">
                
                <div class="mb-10">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Selamat Datang!</h2>
                    <p class="text-gray-600">Silakan pilih menu di bawah untuk memulai sesi Anda.</p>
                </div>

                <div class="space-y-4">
                    <a href="{{ route('login') }}" class="w-full block py-4 px-6 border-2 border-blue-600 text-blue-600 font-bold rounded-2xl hover:bg-blue-600 hover:text-white transition duration-300">
                        Masuk ke Sistem
                    </a>
                    
                    <a href="{{ route('register') }}" class="w-full block py-4 px-6 bg-blue-600 text-white font-bold rounded-2xl shadow-lg hover:bg-blue-700 transition duration-300">
                        Daftar Anggota Baru
                    </a>
                </div>

                <p class="mt-8 text-sm text-gray-400">©{{ date('Y') }} HiPerpus | Kelompok 5</p>
            </div>
        </div>
        
    </div>
</body>
</html>