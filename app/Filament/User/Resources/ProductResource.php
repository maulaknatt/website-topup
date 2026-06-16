<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Transaksi;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Beli Produk';
    protected static ?string $modelLabel = 'Produk';
    protected static ?string $pluralModelLabel = 'Katalog Produk';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        // Users do not create or edit products
        return $form;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->badge()
                    ->color(fn (int $state): string => $state > 0 ? 'success' : 'danger')
                    ->formatStateUsing(fn ($state) => $state > 0 ? "Tersedia ({$state})" : 'Habis')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('buy')
                    ->label('Beli Sekarang')
                    ->icon('heroicon-m-shopping-cart')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pembelian')
                    ->modalDescription(fn (Product $record): string => "Apakah Anda yakin ingin membeli {$record->name} seharga Rp " . number_format($record->price, 0, ',', '.') . "?")
                    ->disabled(fn (Product $record): bool => $record->stock <= 0)
                    ->action(function (Product $record) {
                        $user = auth()->user();

                        if ($record->stock <= 0) {
                            Notification::make()
                                ->title('Pembelian Gagal')
                                ->body('Maaf, stok produk ini telah habis.')
                                ->danger()
                                ->send();
                            return;
                        }

                        if ($user->saldo < $record->price) {
                            Notification::make()
                                ->title('Pembelian Gagal')
                                ->body('Saldo Anda tidak mencukupi. Silakan lakukan deposit/topup terlebih dahulu.')
                                ->danger()
                                ->send();
                            return;
                        }

                        DB::transaction(function () use ($record, $user) {
                            // Deduct User's balance
                            $user->saldo -= $record->price;
                            $user->save();

                            // Decrement Product stock
                            $record->decrement('stock');

                            // Create Transaksi record
                            Transaksi::create([
                                'user_id' => $user->id,
                                'product_id' => $record->id,
                                'total_pembayaran' => $record->price,
                                'tanggal_transaksi' => now(),
                                'status_pembayaran' => 'pending',
                            ]);
                        });

                        Notification::make()
                            ->title('Pembelian Diproses')
                            ->body("Anda telah memesan {$record->name} seharga Rp " . number_format($record->price, 0, ',', '.') . ". Pesanan Anda sedang menunggu konfirmasi admin.")
                            ->warning()
                            ->send();
                    }),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
        ];
    }
}
