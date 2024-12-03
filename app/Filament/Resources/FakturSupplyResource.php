<?php
namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FakturSupplyResource\Pages;
use App\Models\FakturSupply;
use App\Models\Karyawan;
use App\Models\Supplier;
use App\Models\Obat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;  // Import for table column
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\NumberInput;  // Import for form date picker
use Filament\Tables\Columns\DateColumn;  // If needed for date columns
use Filament\Tables\Columns\DateTimeColumn;  // For DateTime column

class FakturSupplyResource extends Resource
{
    protected static ?string $model = FakturSupply::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form fields for the FakturSupply
                Forms\Components\TextInput::make('no')
                    ->label('Nomor Faktur')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal Faktur')
                    ->required(),

                Forms\Components\Select::make('id_karyawan')
                    ->label('Karyawan')
                    ->options(Karyawan::all()->pluck('nama', 'id_karyawan'))
                    ->required(),

                Forms\Components\Select::make('id_supplier')
                    ->label('Supplier')
                    ->options(Supplier::all()->pluck('nama', 'id_supplier'))
                    ->required(),

                Forms\Components\Select::make('id_obat')
                    ->label('Obat')
                    ->options(Obat::all()->pluck('nama', 'id_obat'))
                    ->required(),

                Forms\Components\TextInput::make('jumlah_obat')
                    ->label('Jumlah Obat')
                    ->required()
                    ->minValue(1),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->required()
                    ->minValue(0),

                Forms\Components\TextInput::make('pajak')
                    ->label('Pajak')
                    ->required()
                    ->minValue(0),

                Forms\Components\TextInput::make('total_bayar')
                    ->label('Total Bayar')
                    ->required()
                    ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            // Kolom nomor faktur
            TextColumn::make('no')
                ->label('Nomor Faktur')
                ->searchable(),

            // Kolom tanggal faktur
            TextColumn::make('tanggal')  
                ->label('Tanggal Faktur')
                ->date('d-m-Y'),  

            // Kolom lainnya
            TextColumn::make('karyawan.nama')
                ->label('Karyawan')
                ->sortable(),

            TextColumn::make('supplier.nama')
                ->label('Supplier')
                ->sortable(),

            TextColumn::make('obat.nama')
                ->label('Obat'),

            TextColumn::make('jumlah_obat')
                ->label('Jumlah Obat'),

            TextColumn::make('total')
                ->label('Total'),

            TextColumn::make('pajak')
                ->label('Pajak'),

            TextColumn::make('total_bayar')
                ->label('Total Bayar'),

            TextColumn::make('created_at')
                ->label('Tanggal Registrasi')
                ->date('d-m-Y'),
        ])
        ->filters([
            Tables\Filters\Filter::make('tanggal')
                ->form([
                    Forms\Components\DatePicker::make('tanggal')
                        ->label('Tanggal Faktur'),
                ])
                ->query(function (Builder $query, array $data) {
                    if ($data['tanggal'] ?? null) {
                        $query->whereDate('tanggal', $data['tanggal']);
                    }
                }),
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
            // Add relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFakturSupplies::route('/'),
            'create' => Pages\CreateFakturSupply::route('/create'),
            'edit' => Pages\EditFakturSupply::route('/{record}/edit'),
        ];
    }
}
