<?php

namespace App\Filament\App\Widgets;

use App\Models\Chauffeur;
use App\Models\Client;
use App\Models\SqaReclamation;
use App\Models\Team;
use App\Models\Vehicule;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAppOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Utilisateurs', Team::find(Filament::getTenant())->first()->members->count())
                ->description('Tous les users de ce site')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('S.Q.A', SqaReclamation::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('Les réclamations S.Q.A')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Véhicules', Vehicule::query()->count())
                ->description('Tous les véhicules de ce site')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Chauffeurs', Chauffeur::query()->count())
                ->description('Tous les chauffeurs de la base de données')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
