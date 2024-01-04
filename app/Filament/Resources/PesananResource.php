<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $pluralModelLabel = 'pesanan';

    protected static ?string $slug = 'pesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('id_karyawan')
                            ->label('Karyawan')
                            ->options(Karyawan::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->required(),

                        Select::make('id_pelanggan')
                            ->label('Pelanggan')
                            ->options(Pelanggan::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->required(),

                        Grid::make()
                            ->schema([
                                DatePicker::make('tanggal_pesanan')
                                    ->label('Tanggal Pesanan')
                                    ->required(),

                                DatePicker::make('tanggal_selesai')
                                    ->label('Tanggal Selesai')
                                    ->required(),
                            ]),

                        TextInput::make('total_harga')
                            ->label('Total Harga')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->step(10000)
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_pelanggan'),
                TextColumn::make('id_karyawan'),
                TextColumn::make('tanggal_pesanan'),
                TextColumn::make('tanggal_selesai'),
                TextColumn::make('berat'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()->label('')->icon(null),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(null)
            ->recordAction(Tables\Actions\ViewAction::class);
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
