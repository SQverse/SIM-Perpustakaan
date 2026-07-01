<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8">
                
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="nama_kategori" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" 
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" 
                               required 
                               placeholder="Contoh: Fiksi, Sains, Sejarah, dll...">
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-md transition transform hover:-translate-y-1">
                            Simpan Kategori
                        </button>
                        <a href="{{ route('kategori.index') }}" class="text-gray-500 hover:text-gray-800 font-semibold transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>