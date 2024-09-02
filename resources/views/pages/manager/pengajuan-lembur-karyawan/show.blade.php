<x-app-layout>
    @section('title', 'Pengajuan Lembur')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-10">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <header>
                <p class="mt-1 text-sm text-gray-600">
                    Pada hari ini,
                    {{ \Carbon\Carbon::parse($data->created_at)->locale('id')->translatedFormat('l, d F Y') }}, saya
                    dengan ini mengajukan permohonan lembur dengan data diri sebagai berikut :
                </p>
            </header>

            <div class="mt-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Nama</td>
                            <td class="px-6 py-4 whitespace-nowrap">: {{ $data->karyawan->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Posisi</td>
                            <td class="px-6 py-4 whitespace-nowrap">: {{ $data->karyawan->posisi->nama }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Tanggal</td>
                            <td class="px-6 py-4 whitespace-nowrap">:
                                {{ \Carbon\Carbon::parse($data->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Jam Mulai</td>
                            <td class="px-6 py-4 whitespace-nowrap">:
                                {{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Jam Selesai</td>
                            <td class="px-6 py-4 whitespace-nowrap">:
                                {{ \Carbon\Carbon::parse($data->jam_selesai)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Durasi</td>
                            <td class="px-6 py-4 whitespace-nowrap">: {{ $data->durasi }}</td>
                        </tr>
                        <tr>
                            <td class="px-0 py-4 whitespace-nowrap font-bold text-gray-900">Pekerjaan</td>
                            <td class="px-6 py-4 whitespace-nowrap">: {{ $data->pekerjaan }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-around mt-12">
                    <div class="text-center">
                        <p class="font-bold text-gray-900">Penerima Tugas</p>
                        <img src="/storage/{{ $data->karyawan->url_tanda_tangan }}" alt="Tanda Tangan" class="mt-2"
                            style="width: 100px; height: auto;">
                        <p class="">{{ $data->karyawan->user->name }}</p>
                    </div>
                    <div class="text-center">
                        <p class="font-bold text-gray-900">Manager</p>
                        <br><br><br><br><br><br>
                        <p class="mt-4">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="flex justify-center mt-8">
                    <form action="/pengajuan-lembur-karyawan/{{ $data->id }}" method="POST"
                        enctype="multipart/form-data" id="approvalForm">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="status" id="status" value="">
                        <input type="file" name="tanda_tangan" id="tanda_tangan" style="display: none;">

                        <button type="button"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-4"
                            onclick="approveRequest()">Setuju</button>

                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                            onclick="setStatus('Tolak')">Tolak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function setStatus(value) {
            document.getElementById('status').value = value;
        }

        async function approveRequest() {
            setStatus('Setuju');

            let imageUrl = '{{ $manager && $manager->url_tanda_tangan ? asset("storage/" . $manager->url_tanda_tangan) : null }}';

            if (imageUrl) {
                const { isConfirmed } = await Swal.fire({
                    title: 'Tanda Tangan yang Sudah Ada',
                    imageUrl: imageUrl,
                    imageAlt: 'Tanda tangan yang sudah ada',
                    showCancelButton: true,
                    confirmButtonText: 'Gunakan yang ada',
                    cancelButtonText: 'Unggah Baru'
                });

                if (isConfirmed) {
                    document.getElementById('approvalForm').submit();
                    return;
                }
            }

            const { value: file } = await Swal.fire({
                title: 'Pilih gambar tanda tangan',
                input: 'file',
                inputAttributes: {
                    'accept': 'image/*',
                    'aria-label': 'Unggah tanda tangan Anda'
                }
            });

            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    Swal.fire({
                        title: 'Pratinjau tanda tangan Anda',
                        imageUrl: e.target.result,
                        imageAlt: 'Gambar tanda tangan yang diunggah',
                        showCancelButton: true,
                        confirmButtonText: 'Gunakan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const fileInput = document.getElementById('tanda_tangan');
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            fileInput.files = dataTransfer.files;

                            document.getElementById('approvalForm').submit();
                        }
                    });
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
