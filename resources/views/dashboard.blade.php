
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Informasi Data Pasien') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                            + Tambah Pasien
                        </button>
                    </div>
                    <table class="min-w-full bg-white border mt-4">
                        <thead>
                            <tr class="bg-green-600 text-white text-left">
                                <th class="py-2 px-4 border">NIK</th>
                                <th class="py-2 px-4 border">Nama</th>
                                <th class="py-2 px-4 border">No. RM</th>
                                <th class="py-2 px-4 border">Alamat</th>
                                <th class="py-2 px-4 border">Agama</th>
                                <th class="py-2 px-4 border">Tanggal Lahir</th>
                                <th class="py-2 px-4 border">Register Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasiens as $pasien)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border">{{ $pasien->nik }}</td>
                                    <td class="py-2 px-4 border">{{ $pasien->nama }}</td>
                                    <td class="py-2 px-4 border">{{ $pasien->no_rm }}</td>
                                    <td class="py-2 px-4 border">{{ $pasien->alamat }}</td>
                                    <td class="py-2 px-4 border">{{ $pasien->agama }}</td>
                                    <td class="py-2 px-4 border">{{ $pasien->tanggal_lahir }}</td>
                                    <td class="py-2 px-4 border">{{ $pasien->register_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-end gap-2 mt-4">
                        <a href="{{ route('pasiens.export.excel') }}" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded">
                        Export Excel
                        </a>

                        <a href="{{ route('pasiens.export.pdf') }}" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded">
                        Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div 
            x-show="open" 
            x-cloak 
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div 
                @click.outside="open = false" 
                class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl"
            >
                <h2 class="text-xl font-semibold mb-4">Tambah Pasien</h2>
                <form action="{{ route('pasiens.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    @csrf

                    <div class="flex flex-col">
                        <label for="nik" class="text-sm text-gray-700 mb-1">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" id="nik" name="nik" required placeholder="Masukkan NIK" class="border px-2 py-1 rounded">
                    </div>

                    <div class="flex flex-col">
                        <label for="nama" class="text-sm text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" required placeholder="Masukkan nama pasien" class="border px-2 py-1 rounded">
                    </div>

                    <div class="flex flex-col">
                        <label for="alamat" class="text-sm text-gray-700 mb-1">Alamat</label>
                        <input type="text" id="alamat" name="alamat" required placeholder="Masukkan alamat lengkap" class="border px-2 py-1 rounded">
                    </div>

                    <div class="flex flex-col">
                        <label for="agama" class="text-sm text-gray-700 mb-1">Agama</label>
                        <select id="agama" name="agama" required class="border px-2 py-1 rounded">
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="tanggal_lahir" class="text-sm text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required class="border px-2 py-1 rounded">
                    </div>

                    <div class="col-span-full flex justify-end gap-2 mt-4">
                        <button type="button" @click="open = false" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
