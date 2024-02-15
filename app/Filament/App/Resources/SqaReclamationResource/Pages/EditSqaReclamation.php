<?php

namespace App\Filament\App\Resources\SqaReclamationResource\Pages;

use App\Filament\App\Resources\SqaReclamationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSqaReclamation extends EditRecord
{
    protected static string $resource = SqaReclamationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
