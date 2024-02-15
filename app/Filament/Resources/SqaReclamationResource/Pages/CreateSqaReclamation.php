<?php

namespace App\Filament\Resources\SqaReclamationResource\Pages;

use App\Filament\Resources\SqaReclamationResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSqaReclamation extends CreateRecord
{
    protected static string $resource = SqaReclamationResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('La requête a été créée')
            ->body('Un message confirme que la requête a été correctement créée.');
    }
}
