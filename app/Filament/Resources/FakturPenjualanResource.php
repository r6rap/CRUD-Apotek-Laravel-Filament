<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FakturPenjualanResource\Pages;
use App\Models\FakturPenjualan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FakturPenjualanResource extends Resource
{
    protected static ?string $model = FakturPenjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no')
                    ->label('Nomor Faktur')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\Select::make('id_pelanggan')
                    ->label('Pelanggan')
                    ->relationship('pelanggan', 'nama') // Asumsi kolom nama di model Pelanggan
                    ->required(),
                Forms\Components\Select::make('id_karyawan')
                    ->label('Karyawan')
                    ->relationship('karyawan', 'nama') // Asumsi kolom nama di model Karyawan
                    ->required(),
                Forms\Components\Select::make('id_obat')
                    ->label('Obat')
                    ->relationship('obat', 'nama_obat') // Asumsi kolom nama_obat di model Obat
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->numeric()
                    ->disabled(),
                Forms\Components\TextInput::make('pajak')
                    ->label('Pajak (%)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('total_bayar')
                    ->label('Total Bayar')
                    ->numeric()
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')->label('Nomor Faktur')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('pelanggan.nama')->label('Pelanggan')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('karyawan.nama')->label('Karyawan')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('obat.nama_obat')->label('Obat')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah')->sortable(),
                Tables\Columns\TextColumn::make('total')->label('Total')->money('IDR'),
                Tables\Columns\TextColumn::make('pajak')->label('Pajak (%)')->sortable(),
                Tables\Columns\TextColumn::make('total_bayar')->label('Total Bayar')->money('IDR'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan RelationManagers jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFakturPenjualans::route('/'),
            'create' => Pages\CreateFakturPenjualan::route('/create'),
            'edit' => Pages\EditFakturPenjualan::route('/{record}/edit'),
        ];
    }
}
