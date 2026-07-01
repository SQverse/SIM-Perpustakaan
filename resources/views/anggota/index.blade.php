<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Anggota HiPerpus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <a href="{{ route('anggota.create') }}" class="inline-block mb-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                        + Tambah Anggota
                    </a>

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b py-2 px-4">No</th>
                                <th class="border-b py-2 px-4">No. Anggota</th>
                                <th class="border-b py-2 px-4">Nama</th>
                                <th class="border-b py-2 px-4">No. HP</th>
                                <th class="border-b py-2 px-4">Alamat</th>
                                <th class="border-b py-2 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_anggota as $index => $item)
                            <tr>
                                <td class="border-b py-2 px-4">{{ $index + 1 }}</td>
                                <td class="border-b py-2 px-4 font-semibold text-blue-600">{{ $item->nomor_anggota }}</td>
                                <td class="border-b py-2 px-4">{{ $item->nama }}</td>
                                <td class="border-b py-2 px-4">{{ $item->no_hp }}</td>
                                <td class="border-b py-2 px-4 truncate max-w-xs">{{ $item->alamat }}</td>
                                <td class="border-b py-2 px-4 flex space-x-4">
                                    <a href="{{ route('anggota.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a>
                                    <span class="text-gray-400">|</span>
                                    <form action="{{ route('anggota.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium bg-transparent border-none cursor-pointer">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>