<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaryawanResource\Pages;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group'; // Ganti ikon sesuai kebutuhan

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input untuk nama karyawan
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Karyawan')
                    ->required()
                    ->maxLength(255),

                // Input untuk alamat
                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->maxLength(500),

                // Input untuk kota
                Forms\Components\TextInput::make('kota')
                    ->label('Kota')
                    ->required()
                    ->maxLength(255),

                // Input untuk status karyawan
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->required(),

                // Input untuk nomor telepon
                Forms\Components\TextInput::make('no_telp')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required()
                    ->maxLength(20),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk nama karyawan
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Karyawan')
                    ->searchable(),

                // Kolom untuk alamat
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat'),

                // Kolom untuk kota
                Tables\Columns\TextColumn::make('kota')
                    ->label('Kota'),

                // Kolom untuk status
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Karyawan'),

                // Kolom untuk nomor telepon
                Tables\Columns\TextColumn::make('no_telp')
                    ->label('Nomor Telepon'),

                // Kolom tanggal pembuatan data
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Registrasi')
                    ->date(),
            ])
            ->filters([
                // Filter berdasarkan status karyawan
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->label('Status'),
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
            // Tambahkan relasi jika diperlukan
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

