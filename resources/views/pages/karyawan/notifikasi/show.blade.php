<x-app-layout>
    @section('title', 'Pengajuan Lembur')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-10">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <header>
                <p class="mt-1 text-sm text-gray-600">
                    Pada hari ini,
                    {{ \Carbon\Carbon::parse($data->suratPerintahLembur->created_at)->locale('id')->translatedFormat('l, d F Y') }}, saya
                    dengan ini mengajukan permohonan lembur dengan data diri sebagai berikut :
                </p>
            </header>

            <div class="mt-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Nama</td>
                            <td class="px-6 py-4 whitespace-nowrap">: {{ $data->suratPerintahLembur->karyawan->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Posisi</td>
                            <td class="px-6 py-4 whitespace-nowrap">: {{ $data->suratPerintahLembur->karyawan->posisi->nama }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Tanggal</td>
                            <td class="px-6 py-4 whitespace-nowrap">:
                                {{ \Carbon\Carbon::parse($data->suratPerintahLembur->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Jam Mulai</td>
                            <td class="px-6 py-4 whitespace-nowrap">:
                                {{ \Carbon\Carbon::parse($data->suratPerintahLembur->jam_mulai)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Jam Selesai</td>
                            <td class="px-6 py-4 whitespace-nowrap">:
                                {{ \Carbon\Carbon::parse($data->suratPerintahLembur->jam_selesai)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Durasi</td>
                            <td class="px-6 py-4 whitespace-nowrap">: {{ $data->suratPerintahLembur->durasi }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Pekerjaan</td>
                            <td class="px-6 py-4 whitespace-nowrap">: {{ $data->suratPerintahLembur->pekerjaan }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-around mt-12">
                    <div class="text-center">
                        <p class="font-bold text-gray-900">Penerima Tugas</p>
                        <img src="/storage/{{ $data->suratPerintahLembur->karyawan->url_tanda_tangan }}" alt="Tanda Tangan" class="mt-2"
                            style="width: 100px; height: auto;">
                        <p class="">{{ $data->suratPerintahLembur->karyawan->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
