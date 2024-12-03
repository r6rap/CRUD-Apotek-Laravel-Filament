<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObatResource\Pages;
use App\Filament\Resources\ObatResource\RelationManagers;
use App\Models\Obat;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObatResource extends Resource
{
    protected static ?string $model = Obat::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    // Form untuk membuat dan mengedit Obat
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Obat')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('jenis')
                    ->label('Jenis Obat')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('harga')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->maxLength(20),

                Forms\Components\TextInput::make('stock')
                    ->label('Stock')
                    ->required()
                    ->numeric()
                    ->minLength(0),

                Forms\Components\Select::make('id_supplier')
                    ->label('Supplier')
                    ->options(Supplier::all()->pluck('nama', 'id_supplier'))
                    ->required()
                    ->searchable(),
            ]);
    }

    // Menampilkan data Obat pada tabel
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Obat')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis Obat')
                    ->limit(50),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable(),

                Tables\Columns\TextColumn::make('supplier.nama')
                    ->label('Nama Supplier')
                    ->sortable(),
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

    // Menambahkan relasi jika ada (misalnya, Obat memiliki relasi ke Supplier)
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Menambahkan halaman untuk list, create, dan edit Obat
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObats::route('/'),
            'create' => Pages\CreateObat::route('/create'),
            'edit' => Pages\EditObat::route('/{record}/edit'),
        ];
    }
}
