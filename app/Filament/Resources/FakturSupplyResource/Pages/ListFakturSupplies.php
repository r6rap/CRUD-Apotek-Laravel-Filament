<?php

namespace App\Filament\Resources\FakturSupplyResource\Pages;

use App\Filament\Resources\FakturSupplyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFakturSupplies extends ListRecords
{
    protected static string $resource = FakturSupplyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
