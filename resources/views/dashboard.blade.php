<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-blue-600 text-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 flex justify-between items-center">
                        <div>
                            <div class="text-3xl font-bold">{{ $totalPasien }}</div>
                            <div class="mt-1 text-lg">Pasien Terdata</div>
                        </div>
                        <div class="text-5xl opacity-25">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="bg-blue-700 hover:bg-blue-800 text-white text-sm py-2 px-4 text-center">
                        <a href="{{ url('/pasiens') }}" class="flex justify-center items-center gap-1">
                            More info <i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-yellow-500 text-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 flex justify-between items-center">
                        <div>
                            <div class="text-3xl font-bold">{{ $totalPendaftaran }}</div>
                            <div class="mt-1 text-lg">Pasien Terdaftar</div>
                        </div>
                        <div class="text-5xl opacity-25">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                    </div>
                    <div class="bg-yellow-600 hover:bg-yellow-700 text-white text-sm py-2 px-4 text-center">
                        <a href="{{ url('/pendaftaran') }}" class="flex justify-center items-center gap-1">
                            More info <i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Data Pasien Terdata</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table table-striped align-middle">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>No. RM</th>
                                    <th>Alamat</th>
                                    <th>Agama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Tanggal Pendaftaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pasiens as $pasien)
                                <tr>
                                    <td>{{ $pasien->nik }}</td>
                                    <td>{{ $pasien->nama }}</td>
                                    <td>{{ $pasien->no_rm }}</td>
                                    <td>{{ $pasien->alamat }}</td>
                                    <td>{{ $pasien->agama }}</td>
                                    <td>{{ $pasien->tanggal_lahir }}</td>
                                    <td>{{ $pasien->register_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tabel Pendaftaran Pasien (kanan) --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Data Pasien Terdaftar</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table table-striped align-middle">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th>Nama</th>
                                    <th>No. RM</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Tanggal Pendaftaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftarans as $pendaftar)
                                <tr>
                                    <td>{{ $pendaftar->nama }}</td>
                                    <td>{{ $pendaftar->no_rm }}</td>
                                    <td>{{ $pendaftar->no_pendaftaran }}</td>
                                    <td>{{ $pendaftar->pendaftaran_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
