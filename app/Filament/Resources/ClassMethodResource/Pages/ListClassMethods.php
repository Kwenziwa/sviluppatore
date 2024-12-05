<?php

namespace App\Filament\Resources\ClassMethodResource\Pages;

use App\Filament\Resources\ClassMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassMethods extends ListRecords
{
    protected static string $resource = ClassMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
