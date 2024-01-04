<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PesananChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik pesanan sebulan terakhir';

    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $pesanan_array = DB::table('pesanan')
            ->selectRaw('tanggal_pesanan, count(tanggal_pesanan) as jumlah')
            ->whereRaw('tanggal_pesanan between SUBDATE(NOW(), 30) and NOW()')
            ->groupBy('tanggal_pesanan')
            ->get()
            ->pluck('jumlah', 'tanggal_pesanan')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Pesanan',
                    'data' => array_values($pesanan_array),
                    'fill' => 'start',
                ],
            ],
            'labels' => array_keys($pesanan_array),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
