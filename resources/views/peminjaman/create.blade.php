<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Transaksi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl p-8">
                
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf 
                    
                    <div class="mb-4">
                        <label for="anggota_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Anggota</label>
                        <select name="anggota_id" id="anggota_id" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                            <option value="">-- Pilih Nama Peminjam --</option>
                            @foreach($data_anggota as $anggota)
                                <option value="{{ $anggota->id }}">{{ $anggota->nomor_anggota }} - {{ $anggota->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="buku_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Buku</label>
                        <select name="buku_id" id="buku_id" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                            <option value="">-- Pilih Buku (Hanya yang tersedia) --</option>
                            @foreach($data_buku as $buku)
                                <option value="{{ $buku->id }}">{{ $buku->judul }} (Sisa Stok: {{ $buku->stok }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="tanggal_pinjam" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                        </div>
                        <div>
                            <label for="tanggal_kembali" class="block text-gray-700 text-sm font-bold mb-2">Batas Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('peminjaman.index') }}" class="text-gray-500 hover:text-gray-700 mr-6 font-medium">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full shadow-md transition transform hover:-translate-y-1">
                            Proses Peminjaman
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>