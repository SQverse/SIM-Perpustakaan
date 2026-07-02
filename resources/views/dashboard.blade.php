<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->role == 'admin' ? __('Dashboard Admin') : __('Ruang Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- TAMPILAN KHUSUS ADMIN -->
            @if(Auth::user()->role == 'admin')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500 font-bold uppercase">Total Koleksi Buku</p>
                        <h3 class="text-4xl font-extrabold text-blue-600 mt-2">{{ $total_buku }}</h3>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500 font-bold uppercase">Total Anggota</p>
                        <h3 class="text-4xl font-extrabold text-indigo-600 mt-2">{{ $total_anggota }}</h3>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500 font-bold uppercase">Buku Sedang Dipinjam</p>
                        <h3 class="text-4xl font-extrabold text-yellow-600 mt-2">{{ $total_pinjam }}</h3>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Statistik Peminjaman Buku</h3>
                    <canvas id="peminjamanChart" height="80"></canvas>
                </div>

                <div class="bg-blue-600 p-8 rounded-3xl shadow-lg text-white mb-8">
                    <h2 class="text-2xl font-bold mb-2">Halo, Admin {{ Auth::user()->name }}! 🚀</h2>
                    <p class="text-blue-100">Selamat datang di pusat kendali HiPerpus. Anda memiliki akses penuh untuk mengelola seluruh data perpustakaan.</p>
                </div>

                {{-- Skrip ditaruh di sini agar tidak memicu error linter --}}
                <div id="chart-data" 
                    data-buku="{{ $total_buku }}" 
                    data-anggota="{{ $total_anggota }}" 
                    data-pinjam="{{ $total_pinjam }}">
                </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // 2. Ambil data dari atribut HTML tadi (VS Code tidak akan error lagi)
                    const el = document.getElementById('chart-data');
                    const dataBuku = parseInt(el.getAttribute('data-buku'));
                    const dataAnggota = parseInt(el.getAttribute('data-anggota'));
                    const dataPinjam = parseInt(el.getAttribute('data-pinjam'));

                    const ctx = document.getElementById('peminjamanChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Total Buku', 'Total Anggota', 'Buku Dipinjam'],
                            datasets: [{
                                label: 'Jumlah Data',
                                data: [dataBuku, dataAnggota, dataPinjam],
                                backgroundColor: ['#2563eb', '#4f46e5', '#d97706'],
                                borderRadius: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: { y: { beginAtZero: true } }
                        }
                    });
                });
            </script>

            <!-- TAMPILAN KHUSUS ANGGOTA -->
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-6">
                        <div class="bg-blue-100 p-4 rounded-full hidden sm:block">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Profil Anggota</p>
                            <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Sedang Dipinjam</p>
                            <div class="flex items-end gap-2 mt-1">
                                <h3 class="text-4xl font-extrabold text-blue-600">{{ $buku_dipinjam_user }}</h3>
                                <span class="text-gray-500 font-medium mb-1">Buku</span>
                            </div>
                        </div>
                        <a href="{{ route('peminjaman.index') }}" class="bg-blue-50 text-blue-700 font-bold py-3 px-5 rounded-xl hover:bg-blue-100 transition">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 rounded-3xl shadow-lg text-white">
                    <h2 class="text-3xl font-bold mb-3">Selamat Datang di HiPerpus! 📚</h2>
                    <p class="text-blue-100 mb-6 max-w-2xl text-lg">Mari jelajahi ribuan koleksi buku kami dan temukan inspirasi barumu hari ini.</p>
                    <a href="{{ route('buku.index') }}" class="inline-block bg-white text-blue-700 font-bold py-3 px-8 rounded-full shadow hover:bg-gray-50 transition transform hover:-translate-y-1">
                        Cari Buku Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>