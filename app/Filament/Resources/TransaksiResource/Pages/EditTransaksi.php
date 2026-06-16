<?php

namespace App\Filament\Resources\TransaksiResource\Pages;

use App\Filament\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaksi extends EditRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        $oldStatus = $record->status_pembayaran;
        $newStatus = $data['status_pembayaran'] ?? $oldStatus;

        if ($oldStatus !== 'gagal' && $newStatus === 'gagal') {
            \Illuminate\Support\Facades\DB::transaction(function () use ($record) {
                if ($record->user) {
                    $record->user->saldo += $record->total_pembayaran;
                    $record->user->save();
                }
                if ($record->product) {
                    $record->product->increment('stock');
                }
            });
        } elseif ($oldStatus === 'gagal' && $newStatus !== 'gagal') {
            \Illuminate\Support\Facades\DB::transaction(function () use ($record) {
                if ($record->user) {
                    $record->user->saldo -= $record->total_pembayaran;
                    $record->user->save();
                }
                if ($record->product) {
                    $record->product->decrement('stock');
                }
            });
        }

        $record->update($data);

        return $record;
    }
}
