<?php

namespace App\Charts;

use App\Models\SuratPerintahLembur;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PengajuanLemburByStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LarapexChart
    {
        $suratLemburDisetujui = SuratPerintahLembur::where('status', 'Setuju')->count();
        $suratLemburDitolak = SuratPerintahLembur::where('status', 'Tolak')->count();
        $suratLemburMenungguPersetujuan = SuratPerintahLembur::where('status', 'Menunggu Persetujuan')->count();
        
        return $this->chart->pieChart()
            ->setTitle('Jumlah berdasarkan status')
            ->addData([
                $suratLemburDisetujui,
                $suratLemburDitolak,
                $suratLemburMenungguPersetujuan
            ])
            ->setLabels(['Setuju', 'Tolak', 'Menunggu Persetujuan'])
            ->setColors(['#4CAF50', '#FF5252', '#FFC107']);
    }
}
