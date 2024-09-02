<x-app-layout>
    @section('title', 'Pengajuan Lembur Karyawan')
    <div class="py-12">
        <div class="max-w-7xl rounded-md mx-auto sm:px-6 lg:px-8 bg-white">
            <div class="card">
                <h5 class="font-bold py-4 text-lg">Data Pengajuan Lembur Karyawan</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table-auto min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Nama Karyawan</th>
                                    <th class="px-4 py-2 text-left">Posisi</th>
                                    <th class="px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border px-4 py-2">{{ $item->karyawan->user->name }}</td>
                                        <td class="border px-4 py-2">{{ $item->karyawan->posisi->nama }}</td>
                                        <td class="border px-4 py-2 flex items-center justify-center">
                                            <div class="flex py-1">
                                                <div class="flex flex-col justify-center items-center">
                                                    <a href="/pengajuan-lembur-karyawan/{{ $item->id }}">
                                                        <button type="button" class="focus:outline-none text-white bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                                </svg>
                                                                <p class="ms-2">Check Pengajuan</p>
                                                            </div>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function confirmDelete(id) {
                    Swal.fire({
                        title: "Apakah Anda Yakin?",
                        text: "Anda tidak akan dapat mengembalikan data ini!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Hapus"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            </script>
        </div>
    </div>
</x-app-layout>
