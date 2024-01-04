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
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
                            ->placeholder('Pilih nama karyawan')
                            ->options(
                                Karyawan::all()
                                    ->mapWithKeys(fn (Model $model) => [
                                        $model['id'] => "$model[nama] ($model[no_telepon])"
                                    ])
                            )
                            ->searchable()
                            ->required(),

                        Select::make('id_pelanggan')
                            ->label('Pelanggan')
                            ->placeholder('Pilih nama pelanggan')
                            ->options(
                                Pelanggan::all()
                                    ->mapWithKeys(fn (Model $model) => [
                                        $model['id'] => "$model[nama] ($model[no_telepon])"
                                    ])
                            )
                            ->searchable()
                            ->required(),

                        Grid::make()
                            ->schema([
                                DatePicker::make('tanggal_pesanan')
                                    ->label('Tanggal Pesanan')
                                    ->required(),

                                DatePicker::make('tanggal_selesai')
                                    ->label('Tanggal Selesai (Kosong jika belum)')
                            ]),

                        TextInput::make('total_harga')
                            ->label('Total Harga')
                            ->numeric()
                            ->prefix('Rp.')
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
                TextColumn::make('no')->rowIndex()->grow(false),
                TextColumn::make('pelanggan.nama')->searchable(),
                TextColumn::make('pelanggan.no_telepon')->searchable()->label('Telp. Pelanggan'),
                TextColumn::make('karyawan.nama')->searchable(),
                TextColumn::make('tanggal_pesanan')->dateTime('d M Y')->sortable(),
                TextColumn::make('tanggal_selesai')->dateTime('d M Y')->sortable()->placeholder('Belum selesai'),
                TextColumn::make('total_harga')->prefix('Rp. ')->numeric(), // TODO
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
