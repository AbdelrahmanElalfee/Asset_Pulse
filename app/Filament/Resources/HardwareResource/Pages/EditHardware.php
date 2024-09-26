<?php

namespace App\Filament\Resources\HardwareResource\Pages;

use App\Filament\Resources\HardwareResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHardware extends EditRecord
{
    protected static string $resource = HardwareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
