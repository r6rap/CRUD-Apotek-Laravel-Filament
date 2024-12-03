<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Form untuk membuat dan mengedit Supplier
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Supplier')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('kota')
                    ->label('Kota')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('no_telp')
                    ->label('No. Telepon')
                    ->required()
                    ->maxLength(20)
                    ->tel(), // Membuat input nomor telepon dengan format yang sesuai

            ]);
    }

    // Menampilkan data Supplier pada tabel
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Supplier')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50),

                Tables\Columns\TextColumn::make('kota')
                    ->label('Kota')
                    ->limit(50),

                Tables\Columns\TextColumn::make('no_telp')
                    ->label('No. Telepon'),
            ])
            ->filters([
                // Filter dapat ditambahkan sesuai kebutuhan
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

    // Menambahkan relasi jika ada (misalnya, Supplier memiliki banyak data terkait)
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Menambahkan halaman untuk list, create, dan edit Supplier
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
