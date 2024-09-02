<?php

namespace App\Charts;

use App\Models\SuratPerintahLembur;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DurasiLemburByKaryawanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LarapexChart
    {
        $data = SuratPerintahLembur::join('karyawans', 'surat_perintah_lemburs.karyawan_id', '=', 'karyawans.id')
            ->join('users', 'karyawans.user_id', '=', 'users.id')
            ->selectRaw('users.name as nama_karyawan, SUM(TIMESTAMPDIFF(HOUR, surat_perintah_lemburs.jam_mulai, surat_perintah_lemburs.jam_selesai)) as total_durasi')
            ->groupBy('nama_karyawan')
            ->get();

        $karyawan = $data->pluck('nama_karyawan')->toArray();
        $durasiLembur = $data->pluck('total_durasi')->toArray();

        return $this->chart->barChart()
            ->addData('Durasi Lembur (Jam)', $durasiLembur)
            ->setXAxis($karyawan)
            ->setColors(['#FF5733', '#33FF57', '#3357FF']);
    }
}
