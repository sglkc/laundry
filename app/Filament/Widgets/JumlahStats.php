<?php

namespace App\Filament\Widgets;

use App\Filament\Resources;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class JumlahStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah karyawan', DB::table('karyawan')->count())
                ->url(Resources\KaryawanResource::getUrl('index'))
                ->icon('heroicon-o-users')
                ->description('terdaftar'),

            Stat::make('Jumlah pelanggan', DB::table('pelanggan')->count())
                ->url(Resources\PelangganResource::getUrl('index'))
                ->icon('heroicon-o-identification')
                ->description('terdaftar'),

            Stat::make('Jumlah pesanan', DB::table('pesanan')->count())
                ->url(Resources\PesananResource::getUrl('index'))
                ->icon('heroicon-o-inbox-stack')
                ->description('tercatat'),

            Stat::make(
                'Pesanan belum selesai',
                DB::table('pesanan')->where('tanggal_selesai', null)->count()
            )
                ->url(Resources\PesananResource::getUrl('index'))
                ->icon('heroicon-m-inbox-stack')
                ->description('dari semua pesanan')
                ->color('warning'),
        ];
    }
}
