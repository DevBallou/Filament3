<?php

namespace App\Filament\Resources\SqaReclamationResource\Pages;

use App\Filament\Resources\SqaReclamationResource;
use App\Models\SqaReclamation;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSqaReclamations extends ListRecords
{
    protected static string $resource = SqaReclamationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Tout' => Tab::make(),
            'Cette Semaine' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
                ->badge(SqaReclamation::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce mois' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(SqaReclamation::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette année' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(SqaReclamation::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
