<?php

namespace App\Filament\App\Resources\SqaReclamationResource\Pages;

use App\Filament\App\Resources\SqaReclamationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSqaReclamations extends ListRecords
{
    protected static string $resource = SqaReclamationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
