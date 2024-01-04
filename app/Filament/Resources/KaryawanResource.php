<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaryawanResource\Pages;
use App\Filament\Resources\KaryawanResource\RelationManagers;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $modelLabel ='karyawan';

    protected static ?string $slug ='karyawan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama')
                            ->required(),
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->required(),
                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->maxDate(now()->subYears(16))
                            ->default(now()->subYears(16))
                            ->required(),
                        Radio::make('jenis_kelamin')
                            ->options([
                                'Pria' => 'Pria',
                                'Wanita' => 'Wanita'
                            ])
                            ->required(),
                        TextInput::make('no_telepon')
                            ->tel()
                            ->numeric()
                            ->label('No Telepon')
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->rowIndex()->grow(false),
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('alamat')->searchable()->sortable(),
                TextColumn::make('tanggal_lahir')->dateTime('d M Y'),
                TextColumn::make('jenis_kelamin'),
                TextColumn::make('no_telepon')->searchable()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->attribute('jenis_kelamin')
                    ->options([
                        'pria' => 'Pria',
                        'wanita' => 'Wanita'
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }
}
