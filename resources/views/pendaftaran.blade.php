<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pendaftaran Pasien') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ open: false, editModalOpen: false, selectedPendaftar: {} }">
        <div class="max-w-screen-xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
                        <form method="GET" class="flex items-center gap-2">
                            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border px-2 py-1 rounded">
                            <button type="submit"
                                class="bg-[#F6C244] hover:bg-[#e3ab2c] text-black px-4 py-1 rounded">
                                Filter
                            </button>
                        </form>
                        <button @click="open = true" type="button"
                            class="font-bold py-2 px-4 rounded text-white transition"
                            style="background-color: #003E93;"
                            onmouseover="this.style.backgroundColor='#002A6D'"
                            onmouseout="this.style.backgroundColor='#003E93'">
                            + Tambah Pendaftaran
                        </button>
                    </div>
                    <table class="min-w-full bg-white border mt-4">
                        <thead>
                            <tr class="bg-green-600 text-white text-left">
                                <th class="py-2 px-4 border">Nama</th>
                                <th class="py-2 px-4 border">No. RM</th>
                                <th class="py-2 px-4 border">No. Pendaftaran</th>
                                <th class="py-2 px-4 border">Tanggal Mendaftar</th>
                                <th class="py-2 px-4 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftaran as $pendaftar)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border">{{ $pendaftar->nama }}</td>
                                    <td class="py-2 px-4 border">{{ $pendaftar->no_rm }}</td>
                                    <td class="py-2 px-4 border">{{ $pendaftar->pendaftaran_date }}</td>
                                    <td class="py-2 px-4 border">
                                        <div class="flex flex-wrap items-center gap-2">
                                            @if ($pendaftar->trashed())
                                                <!-- Tombol Restore -->
                                                <form action="{{ route('pendaftaran.restore', $pasien->id) }}" method="POST" onsubmit="return confirm('Kembalikan data ini?')" class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                            class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded text-sm inline-flex items-center justify-center"
                                                            title="Restore">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M4.5 12a7.5 7.5 0 0113.05-4.743M19.5 12a7.5 7.5 0 01-13.05 4.743m13.05-4.743H15m4.5 0V8" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                <!-- Tombol Hapus Permanen -->
                                                <form action="{{ route('pendaftaran.forceDelete', $pasien->id) }}" method="POST" onsubmit="return confirm('Hapus permanen data ini?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-800 hover:bg-red-900 text-white p-2 rounded text-sm inline-flex items-center justify-center"
                                                            title="Hapus Permanen">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Tombol Edit -->
                                                <button 
                                                    @click="editModalOpen = true; selectedPendaftar = {{ json_encode($pasien) }}" 
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded text-sm inline-flex items-center justify-center"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536M9 13l6-6m2-2a2.828 2.828 0 114 4L9 21H5v-4L17.232 5.232z"/>
                                                    </svg>
                                                </button>

                                                <!-- Tombol Soft Delete (Trash Icon) -->
                                                <form action="{{ route('pendaftaran.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white p-2 rounded text-sm inline-flex items-center justify-center"
                                                            title="Soft Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-6 0V5a2 2 0 012-2h2a2 2 0 012 2v2" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-end gap-2 mt-4">
                        <a href="{{ route('pendaftaran.export.excel') }}" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded">
                        Export Excel
                        </a>

                        <a href="{{ route('pendaftaran.export.pdf') }}" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded">
                        Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Data Pasien -->
        <div 
            x-show="open" 
            x-cloak 
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div 
                @click.outside="open = false" 
                class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl"
            >
                <h2 class="text-xl font-semibold mb-4">Daftar Pasien</h2>
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    @csrf

                    <div class="flex flex-col">
                        <label for="nama" class="text-sm text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" required placeholder="Masukkan nama pasien" class="border px-2 py-1 rounded">
                    </div>

                    <div class="flex flex-col">
                        <label for="tanggal_lahir" class="text-sm text-gray-700 mb-1">Tanggal Pendaftaran</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required class="border px-2 py-1 rounded">
                    </div>

                    <div class="col-span-full flex justify-end gap-2 mt-4">
                        <button type="button" @click="open = false" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            Cancel
                        </button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit Pasien -->
        <div x-show="editModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div @click.outside="editModalOpen = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-semibold mb-4">Edit Pasien</h2>
                <form :action="`/pendaftaran/${selectedPendaftar.id}`" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4">
                    @csrf
                    @method('PUT')
                    
                    <input type="text" name="nama" class="border px-2 py-1 rounded" x-model="selectedPendaftar.nama">

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="editModalOpen = false" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
