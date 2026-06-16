<?php

namespace App\Livewire;

use Filament\Widgets\ChartWidget;
use App\Models\Kritik_saran;

class Kritik extends ChartWidget
{
    protected static ?string $heading = 'Trend Kepuasan Pelanggan';

    protected function getType(): string
    {
        return 'line';
    }


    protected function getData(): array
    {
        // Ambil rata-rata kepuasan per hari selama 30 hari terakhir
        $raw = Kritik_saran::query()
            ->whereNotNull('kepuasan')
            ->where('waktu_input', '>=', now()->subDays(30))
            ->selectRaw('DATE(waktu_input) as date, AVG(kepuasan) as avg_rating')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $raw->pluck('date')->all(); // sudah "YYYY-MM-DD"
        $data   = $raw->pluck('avg_rating')->map(fn($v) => round($v, 2))->all();

        return [
            'labels'   => $labels,
            'datasets' => [
                [
                    'label' => 'Rata-rata Kepuasan',
                    'data'  => $data,
                ],
            ],
        ];
    }
}
