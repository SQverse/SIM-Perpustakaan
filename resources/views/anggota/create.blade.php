<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Anggota Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl p-8">
                
                <form action="{{ route('anggota.store') }}" method="POST">
                    @csrf 
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="nomor_anggota" class="block text-gray-700 text-sm font-bold mb-2">Nomor Anggota</label>
                            <input type="text" name="nomor_anggota" id="nomor_anggota" placeholder="Contoh: AGT-001" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                        </div>
                        <div>
                            <label for="no_hp" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="Contoh: 08123456789" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="border border-gray-300 rounded-xl w-full py-2 px-4" required>
                    </div>

                    <div class="mb-6">
                        <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat Domisili</label>
                        <textarea name="alamat" id="alamat" rows="3" class="border border-gray-300 rounded-xl w-full py-2 px-4" required></textarea>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('anggota.index') }}" class="text-gray-500 hover:text-gray-700 mr-6 font-medium">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full shadow-md transition transform hover:-translate-y-1">
                            Simpan Anggota
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>