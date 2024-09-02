<x-app-layout>
    @section('title', 'Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Row for two charts side by side -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card for Durasi Lembur by Karyawan Chart -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-4 border-b">
                        <h3 class="font-semibold text-lg text-gray-700">Total Durasi Lembur per Karyawan</h3>
                    </div>
                    <div class="p-6">
                        {!! $durasiLemburByKaryawanChart->container() !!}
                    </div>
                </div>

                <!-- Card for Pengajuan Lembur by Status Chart -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-4 border-b">
                        <h3 class="font-semibold text-lg text-gray-700">Surat Perintah Lembur per Status</h3>
                    </div>
                    <div class="p-6">
                        {!! $pengajuanLemburByStatusChart->container() !!}
                    </div>
                </div>
            </div>

            <!-- Row for the line chart with full width -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-4 border-b">
                    <h3 class="font-semibold text-lg text-gray-700">Jumlah Pengajuan Lembur per Bulan</h3>
                </div>
                <div class="p-6">
                    {!! $pengajuanLemburPerBulanChart->container() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Include LarapexCharts CDN -->
    <script src="{{ $durasiLemburByKaryawanChart->cdn() }}"></script>
    <script src="{{ $pengajuanLemburByStatusChart->cdn() }}"></script>
    <script src="{{ $pengajuanLemburPerBulanChart->cdn() }}"></script>

    <!-- LarapexCharts Script -->
    {{ $durasiLemburByKaryawanChart->script() }}
    {{ $pengajuanLemburByStatusChart->script() }}
    {{ $pengajuanLemburPerBulanChart->script() }}
</x-app-layout>
