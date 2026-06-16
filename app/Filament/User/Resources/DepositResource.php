<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\DepositResource\Pages;
use App\Models\Deposit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Deposit / Topup';
    protected static ?string $modelLabel = 'Deposit';
    protected static ?string $pluralModelLabel = 'Riwayat Deposit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah Topup (Rupiah)')
                    ->numeric()
                    ->required()
                    ->minValue(10000)
                    ->placeholder('Minimal Rp 10.000')
                    ->prefix('Rp')
                    ->helperText('Masukkan nominal kelipatan rupiah tanpa titik/koma. Contoh: 50000'),

                Forms\Components\Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'PERMATAVA' => 'Permata VA',
                        'BNIVA' => 'BNI VA',
                        'BRIVA' => 'BRI VA',
                        'MANDIRIVA' => 'Mandiri VA',
                        'BCAVA' => 'BCA VA',
                        'ALFAMART' => 'Alfamart',
                        'INDOMARET' => 'Indomaret',
                        'QRISC' => 'QRIS (E-Wallet)',
                    ])
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal & Waktu')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Nominal')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Menunggu Pembayaran',
                        'success' => 'Berhasil',
                        'failed' => 'Gagal / Kedaluwarsa',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('external_id')
                    ->label('Reference ID'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('pay')
                    ->label('Bayar Sekarang')
                    ->url(fn (Deposit $record): string => $record->checkout_url ?? '#')
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-credit-card')
                    ->color('success')
                    ->visible(fn (Deposit $record): bool => $record->status === 'pending' && !empty($record->checkout_url)),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeposits::route('/'),
            'create' => Pages\CreateDeposit::route('/create'),
        ];
    }
}
