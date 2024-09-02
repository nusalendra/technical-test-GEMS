<x-app-layout>
    @section('title', 'Pengajuan Lembur')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-14">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Pengajuan Lembur') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Pada hari ini, ') . \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') . __(', saya dengan ini mengajukan permohonan lembur dengan data diri sebagai berikut :') }}
                </p>
            </header>

            <form id="lemburForm" method="post" action="/pengajuan-lembur" class="mt-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name', $user->name)" readonly autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="posisi" :value="__('Posisi')" />
                    <x-text-input id="posisi" name="posisi" type="text" class="mt-1 block w-full"
                        :value="old('posisi', $user->karyawan->posisi->nama)" readonly autocomplete="posisi" />
                    <x-input-error class="mt-2" :messages="$errors->get('posisi')" />
                </div>

                <div>
                    <x-input-label for="tanggal" :value="__('Tanggal')" />
                    <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full"
                        :value="old('tanggal')" required autocomplete="tanggal" />
                    <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
                </div>

                <div>
                    <x-input-label for="jam_mulai" :value="__('Jam Mulai')" />
                    <x-text-input id="jam_mulai" name="jam_mulai" type="time" class="mt-1 block w-full"
                        :value="old('jam_mulai')" required autocomplete="jam_mulai" />
                    <x-input-error class="mt-2" :messages="$errors->get('jam_mulai')" />
                </div>

                <div>
                    <x-input-label for="jam_selesai" :value="__('Jam Selesai')" />
                    <x-text-input id="jam_selesai" name="jam_selesai" type="time" class="mt-1 block w-full"
                        :value="old('jam_selesai')" required autocomplete="jam_selesai" />
                    <x-input-error class="mt-2" :messages="$errors->get('jam_selesai')" />
                </div>

                <div>
                    <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                    <x-text-input id="pekerjaan" name="pekerjaan" type="text" class="mt-1 block w-full"
                        :value="old('pekerjaan')" required autocomplete="pekerjaan" />
                    <x-input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button type="button" id="submitLembur">{{ __('Ajukan') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('submitLembur').addEventListener('click', async function() {
            const {
                value: file
            } = await Swal.fire({
                title: 'Unggah Tanda Tangan',
                input: 'file',
                inputAttributes: {
                    accept: 'image/*',
                    'aria-label': 'Unggah tanda tangan Anda'
                }
            });

            if (file) {
                const form = document.getElementById('lemburForm');
                const formData = new FormData(form);
                formData.append('tanda_tangan', file);

                fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    }
                }).then(response => {
                    if (response.ok) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pengajuan lembur berhasil diajukan.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = '/pengajuan-lembur';
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mengajukan lembur.',
                            icon: 'error'
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengajukan lembur.',
                        icon: 'error'
                    });
                });
            }
        });
    </script>
</x-app-layout>
