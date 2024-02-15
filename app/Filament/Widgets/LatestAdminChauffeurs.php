<?php

namespace App\Filament\Widgets;

use App\Models\Chauffeur;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAdminChauffeurs extends BaseWidget
{
    protected static ?string $heading = 'Derniers inscrits affiche la liste des chauffeurs';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Chauffeur::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('full_name')->label('Nom & Prénom'),
                Tables\Columns\TextColumn::make('mat'),
                Tables\Columns\TextColumn::make('tel'),
                Tables\Columns\TextColumn::make('dateEmbauche')->date(),
                Tables\Columns\TextColumn::make('cin'),
                Tables\Columns\TextColumn::make('adresse'),
            ]);
    }
}
