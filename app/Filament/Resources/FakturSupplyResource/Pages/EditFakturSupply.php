<?php

namespace App\Filament\Resources\FakturSupplyResource\Pages;

use App\Filament\Resources\FakturSupplyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFakturSupply extends EditRecord
{
    protected static string $resource = FakturSupplyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
