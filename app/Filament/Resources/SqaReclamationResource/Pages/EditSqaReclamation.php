<?php

namespace App\Filament\Resources\SqaReclamationResource\Pages;

use App\Filament\Resources\SqaReclamationResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditSqaReclamation extends EditRecord
{
    protected static string $resource = SqaReclamationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('La requête a été mis à jour')
            ->body('Un message confirme que la requête a été mis à jour avec succès.');
    }
}
