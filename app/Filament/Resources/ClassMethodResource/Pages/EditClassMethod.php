<?php

namespace App\Filament\Resources\ClassMethodResource\Pages;

use App\Filament\Resources\ClassMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassMethod extends EditRecord
{
    protected static string $resource = ClassMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
