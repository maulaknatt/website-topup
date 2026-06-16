<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TransaksiResource\Pages;
use App\Models\Transaksi;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationLabel = 'Riwayat Transaksi';
    protected static ?string $modelLabel = 'Transaksi';
    protected static ?string $pluralModelLabel = 'Riwayat Transaksi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        // Users do not manually create or edit transaction records
        return $form;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaksi_id')
                    ->label('ID Transaksi')
                    ->formatStateUsing(function ($state, $record) {
                        $userAbbr = collect(explode(' ', $record->user?->name ?? auth()->user()->name ?? ''))->map(fn($w) => strtoupper(substr($w, 0, 1)))->join('');
                        $prodAbbr = collect(explode(' ', $record->product?->name ?? 'DEP'))->map(fn($w) => strtoupper(substr($w, 0, 1)))->join('');
                        return "{$state}-{$userAbbr}-{$prodAbbr}";
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->placeholder('Topup Saldo / Lainnya')
                    ->searchable(),

                Tables\Columns\TextColumn::make('metodePembayaran.nama_metode')
                    ->label('Metode')
                    ->placeholder('Saldo Akun')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_pembayaran')
                    ->label('Total Pembayaran')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'sukses' => 'success',
                        'gagal' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_transaksi')
                    ->label('Tanggal Pembelian')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['product', 'metodePembayaran'])
            ->where('user_id', auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
        ];
    }
}
