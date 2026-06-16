<?php

namespace App\Filament\User\Resources\KritikSaranResource\Pages;

use App\Filament\User\Resources\KritikSaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKritikSarans extends ListRecords
{
    protected static string $resource = KritikSaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
