<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\RekapStats;
use Filament\Pages\Page;

class Rekap extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationLabel = 'Rekap Laporan';
    protected static ?string $title = 'Rekap Laporan';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.rekap';

    protected function getHeaderWidgets(): array
    {
        return [
            RekapStats::class,
        ];
    }
}
