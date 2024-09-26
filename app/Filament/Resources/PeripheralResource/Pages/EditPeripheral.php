<?php

namespace App\Filament\Resources\PeripheralResource\Pages;

use App\Filament\Resources\PeripheralResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeripheral extends EditRecord
{
    protected static string $resource = PeripheralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
