<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Koleksi Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8">
                
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('buku.create') }}" class="inline-block mb-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl shadow-md transition transform hover:-translate-y-1">
                        + Tambah Buku Baru
                    </a>
                @endif

                <form action="{{ route('buku.index') }}" method="GET" class="mb-6 bg-gray-50 p-4 rounded-2xl border border-gray-100 flex flex-col sm:flex-row gap-4">
                    
                    <div class="flex-1">
                        <label for="search" class="sr-only">Cari Buku</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition" 
                                placeholder="Cari judul buku atau pengarang...">
                        </div>
                    </div>

                    <div class="sm:w-64">
                        <label for="kategori_id" class="sr-only">Filter Kategori</label>
                        <select name="kategori_id" id="kategori_id" 
                            class="block w-full py-2 pl-3 pr-10 border border-gray-300 bg-white rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition">
                            <option value="">Semua Kategori</option>
                            @foreach($data_kategori as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-gray-800 text-white px-5 py-2 rounded-xl text-sm font-bold shadow hover:bg-gray-700 transition">
                            Terapkan
                        </button>
                        @if(request('search') || request('kategori_id'))
                            <a href="{{ route('buku.index') }}" class="bg-white border border-gray-300 text-gray-700 px-5 py-2 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50 transition flex items-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                                <th class="border-b py-3 px-4 rounded-tl-xl">No</th>
                                <th class="border-b py-3 px-4">Judul Buku</th>
                                <th class="border-b py-3 px-4">Pengarang</th>
                                <th class="border-b py-3 px-4">Kategori</th>
                                <th class="border-b py-3 px-4">Stok</th>
                                <th class="border-b py-3 px-4">Tahun</th>
                                
                                @if(Auth::user()->role == 'admin')
                                    <th class="border-b py-3 px-4 rounded-tr-xl text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($data_buku as $index => $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="border-b py-3 px-4">{{ $index + 1 }}</td>
                                <td class="border-b py-3 px-4 font-bold text-gray-900">{{ $item->judul }}</td>
                                <td class="border-b py-3 px-4">{{ $item->pengarang }}</td>
                                <td class="border-b py-3 px-4">
                                    <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                                        {{ $item->kategori->nama_kategori }}
                                    </span>
                                </td>
                                <td class="border-b py-3 px-4">
                                    @if($item->stok > 0)
                                        <span class="font-bold text-green-600">{{ $item->stok }}</span>
                                    @else
                                        <span class="font-bold text-red-500">Habis</span>
                                    @endif
                                </td>
                                <td class="border-b py-3 px-4">{{ $item->tahun_terbit }}</td>
                                
                                @if(Auth::user()->role == 'admin')
                                    <td class="border-b py-3 px-4 text-center space-x-2">
                                        <a href="{{ route('buku.edit', $item->id) }}" class="inline-block bg-yellow-100 text-yellow-700 hover:bg-yellow-200 font-bold py-1 px-3 rounded-lg text-sm transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('buku.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 font-bold py-1 px-3 rounded-lg text-sm transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>