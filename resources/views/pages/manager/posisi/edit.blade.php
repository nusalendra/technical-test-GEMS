<x-app-layout>
    @section('title', 'Edit Karyawan')
    <div class="py-12">
        <div class="max-w-5xl rounded-lg mx-auto sm:px-6 lg:px-8 bg-white shadow-md mb-4">
            <div class="max-w-4xl mx-auto py-6">
                <h5 class="py-1 mb-4 text-black font-semibold text-xl">Edit Data Karyawan</h5>
                <form action="/posisi/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Nama Posisi" value="{{ $data->nama }}">
                    </div>
                    <div class="flex justify-end">
                        <a href="/posisi">
                            <button type="button"
                                class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Kembali</button>
                        </a>
                        <div class="ms-2">
                            <button type="submit"
                                class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error'
            });
        @elseif (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success'
            });
        @endif
    </script>
</x-app-layout>
