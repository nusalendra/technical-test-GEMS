<?php

namespace App\Charts;

use App\Models\SuratPerintahLembur;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class PengajuanLemburPerBulanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LarapexChart
    {
        $data = SuratPerintahLembur::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $allMonths = collect(range(1, 12))->map(function ($month) use ($data) {
            return [
                'bulan' => Carbon::create()->month($month)->format('F'),
                'jumlah' => $data->firstWhere('bulan', $month)['jumlah'] ?? 0
            ];
        });

        return $this->chart->lineChart()
            ->setTitle('Tahun ' . Carbon::now()->year)
            ->addData('Jumlah Pengajuan', $allMonths->pluck('jumlah')->toArray())
            ->setXAxis($allMonths->pluck('bulan')->toArray())
            ->setColors(['#3B82F6', '#8B5CF6', '#F97316']);
    }
}
