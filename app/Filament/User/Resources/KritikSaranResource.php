<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\KritikSaranResource\Pages;
use App\Models\Kritik_saran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KritikSaranResource extends Resource
{
    protected static ?string $model = Kritik_saran::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Kritik & Saran';
    protected static ?string $modelLabel = 'Kritik & Saran';
    protected static ?string $pluralModelLabel = 'Kritik & Saran';
    protected static ?int $navigationSort = 99;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('transaksi_id')
                    ->label('Transaksi Terkait (Opsional)')
                    ->relationship(
                        'transaksi', 
                        'transaksi_id', 
                        fn (Builder $query) => $query->where('user_id', auth()->id())
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Transaksi #{$record->transaksi_id} - Rp " . number_format($record->total_pembayaran, 0, ',', '.')),

                Forms\Components\Radio::make('kepuasan')
                    ->label('Tingkat Kepuasan')
                    ->options([
                        '1' => 'Sangat Tidak Puas',
                        '2' => 'Tidak Puas',
                        '3' => 'Cukup',
                        '4' => 'Puas',
                        '5' => 'Sangat Puas',
                    ])
                    ->inline()
                    ->required(),

                Forms\Components\Textarea::make('isi_pesan')
                    ->label('Isi Pesan / Feedback')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),

                Forms\Components\Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaksi_id')
                    ->label('Transaksi ID')
                    ->formatStateUsing(fn ($state) => $state ? "#{$state}" : '-'),

                Tables\Columns\TextColumn::make('kepuasan')
                    ->label('Kepuasan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'danger',
                        '2' => 'warning',
                        '3' => 'gray',
                        '4' => 'info',
                        '5' => 'success',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        '1' => 'Sangat Tidak Puas',
                        '2' => 'Tidak Puas',
                        '3' => 'Cukup',
                        '4' => 'Puas',
                        '5' => 'Sangat Puas',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('isi_pesan')
                    ->label('Isi Pesan')
                    ->limit(50),

                Tables\Columns\TextColumn::make('status_tanggapan')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'belum_ditanggapi',
                        'success' => 'ditanggapi',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'belum_ditanggapi' => 'Belum Ditanggapi',
                        'ditanggapi' => 'Ditanggapi',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('waktu_input')
                    ->label('Waktu Dikirim')
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
            'index' => Pages\ListKritikSarans::route('/'),
            'create' => Pages\CreateKritikSaran::route('/create'),
        ];
    }
}
