<?php

namespace App\Filament\Widgets;

use App\Models\Chauffeur;
use App\Models\Client;
use App\Models\Vehicule;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Véhicules', Vehicule::query()->count())
                ->description('Tous les véhicules de ce site')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Clients', Client::query()->count())
                ->description('Tous les clients de la base de données')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Chauffeurs', Chauffeur::query()->count())
                ->description('Tous les chauffeurs de la base de données')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
