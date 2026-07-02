<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight print:hidden">
            {{ Auth::user()->role == 'admin' ? __('Sirkulasi Peminjaman') : __('Riwayat Peminjaman Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8">
                
                <div class="hidden print:block text-center mb-8 border-b-4 border-gray-800 pb-4">
                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-wider">LAPORAN DATA PEMINJAMAN</h1>
                    <h2 class="text-2xl font-bold text-blue-600 mt-1">Perpustakaan Digital HiPerpus</h2>
                    <p class="text-gray-500 text-sm mt-2">Dicetak pada: {{ now()->format('d F Y (H:i)') }} | Oleh: {{ Auth::user()->name }}</p>
                </div>

                <div class="flex justify-between items-center mb-6 print:hidden">
                    
                    <div>
                        <a href="{{ route('peminjaman.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl shadow-md transition">
                            {{ Auth::user()->role == 'admin' ? '+ Catat Transaksi Baru' : '+ Pinjam Buku Baru' }}
                        </a>
                    </div>
                    
                    @if(Auth::user()->role == 'admin')
                    <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-xl shadow-md transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Cetak Laporan (PDF)
                    </button>
                    @endif

                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 print:bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                                <th class="border-b py-3 px-4">No</th>
                                <th class="border-b py-3 px-4">Nama Peminjam</th>
                                <th class="border-b py-3 px-4">Judul Buku</th>
                                <th class="border-b py-3 px-4">Tgl Pinjam</th>
                                <th class="border-b py-3 px-4">Tgl Kembali</th>
                                <th class="border-b py-3 px-4">Status</th>
                                <th class="border-b py-3 px-4 text-center print:hidden">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($data_peminjaman as $index => $pinjam)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border-b py-3 px-4">{{ $index + 1 }}</td>
                                <td class="border-b py-3 px-4 font-semibold">{{ $pinjam->anggota->nama ?? $pinjam->user->name ?? 'Umum' }}</td>
                                <td class="border-b py-3 px-4 font-medium text-gray-900">{{ $pinjam->buku->judul }}</td>
                                <td class="border-b py-3 px-4">{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d/m/Y') }}</td>
                                <td class="border-b py-3 px-4">{{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d/m/Y') }}</td>
                                <td class="border-b py-3 px-4">
                                    <span class="{{ $pinjam->status == 'dipinjam' ? 'text-yellow-600 bg-yellow-50 border-yellow-200' : 'text-green-600 bg-green-50 border-green-200' }} text-xs font-bold px-3 py-1 rounded-full border">
                                        {{ ucfirst($pinjam->status) }}
                                    </span>
                                </td>
                                <td class="border-b py-3 px-4 text-center print:hidden">
                                    @if($pinjam->status == 'dipinjam' && Auth::user()->role == 'admin')
                                        <form action="{{ route('peminjaman.kembali', $pinjam->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="bg-blue-100 text-blue-700 hover:bg-blue-200 font-bold py-1 px-3 rounded-lg text-sm transition">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-400">Belum ada riwayat transaksi peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>