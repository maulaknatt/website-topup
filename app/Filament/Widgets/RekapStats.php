<?php

namespace App\Filament\Widgets;

use App\Models\Deposit;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kritik_saran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RekapStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUserSaldo = User::where('role', 'user')->sum('saldo');
        $totalSuccessDeposits = Deposit::where('status', 'success')->sum('amount');
        $totalSuccessPurchases = Transaksi::where('status_pembayaran', 'sukses')->sum('total_pembayaran');
        
        $averageSatisfaction = Kritik_saran::avg('kepuasan');
        $averageSatisfactionFormatted = $averageSatisfaction ? number_format($averageSatisfaction, 1) . ' / 5.0' : 'Belum Ada';

        return [
            Stat::make('Total Saldo Pengguna', 'Rp ' . number_format($totalUserSaldo, 0, ',', '.'))
                ->description('Total akumulasi saldo aktif semua user')
                ->descriptionIcon('heroicon-m-wallet')
                ->color('primary'),

            Stat::make('Total Deposit Berhasil', 'Rp ' . number_format($totalSuccessDeposits, 0, ',', '.'))
                ->description('Total akumulasi uang deposit masuk')
                ->descriptionIcon('heroicon-m-arrow-down-circle')
                ->color('success'),

            Stat::make('Total Pembelian Produk', 'Rp ' . number_format($totalSuccessPurchases, 0, ',', '.'))
                ->description('Total akumulasi nilai pembelian produk')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),

            Stat::make('Rata-rata Kepuasan User', $averageSatisfactionFormatted)
                ->description('Dari seluruh feedback kritik & saran')
                ->descriptionIcon('heroicon-m-star')
                ->color($averageSatisfaction >= 4 ? 'success' : ($averageSatisfaction >= 3 ? 'warning' : 'danger')),
        ];
    }
}
