<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Koleksi Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl p-8">
                
                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf 
                    
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Buku</label>
                        <input type="text" name="judul" id="judul" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                    </div>

                    <div class="mb-4">
                        <label for="pengarang" class="block text-gray-700 text-sm font-bold mb-2">Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                    </div>

                    <div class="mb-4">
                        <label for="kategori_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori Buku</label>
                        <select name="kategori_id" id="kategori_id" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($data_kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok Buku</label>
                            <input type="number" name="stok" id="stok" min="0" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                        </div>
                        <div>
                            <label for="tahun_terbit" class="block text-gray-700 text-sm font-bold mb-2">Tahun Terbit</label>
                            <input type="text" name="tahun_terbit" id="tahun_terbit" maxlength="4" placeholder="Contoh: 2024" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('buku.index') }}" class="text-gray-500 hover:text-gray-700 mr-6 font-medium">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full shadow-md transition transform hover:-translate-y-1">
                            Simpan Buku
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>