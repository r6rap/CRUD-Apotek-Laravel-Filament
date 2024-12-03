<?php

namespace App\Filament\Resources\FakturPenjualanResource\Pages;

use App\Filament\Resources\FakturPenjualanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFakturPenjualan extends EditRecord
{
    protected static string $resource = FakturPenjualanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
