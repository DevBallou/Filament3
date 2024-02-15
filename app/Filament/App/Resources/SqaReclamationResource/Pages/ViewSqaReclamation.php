<?php

namespace App\Filament\App\Resources\SqaReclamationResource\Pages;

use App\Filament\App\Resources\SqaReclamationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSqaReclamation extends ViewRecord
{
    protected static string $resource = SqaReclamationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
