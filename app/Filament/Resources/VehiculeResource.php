<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehiculeResource\Pages;
use App\Filament\Resources\VehiculeResource\RelationManagers;
use App\Models\Vehicule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehiculeResource extends Resource
{
    protected static ?string $model = Vehicule::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Gestion des Véhicules';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->numeric(),
                Forms\Components\TextInput::make('numchassis')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('matricule')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('matriculeWW')
                    ->maxLength(255),
                Forms\Components\TextInput::make('matriculeSTCR')
                    ->maxLength(255),
                Forms\Components\TextInput::make('marque')
                    ->maxLength(255),
                Forms\Components\TextInput::make('modele')
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('capacite')
                    ->numeric(),
                Forms\Components\TextInput::make('station_autorise1')
                    ->maxLength(255),
                Forms\Components\TextInput::make('station_autorise2')
                    ->maxLength(255),
                Forms\Components\TextInput::make('affectation')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ville')
                    ->maxLength(255),
                Forms\Components\TextInput::make('societe')
                    ->maxLength(100),
                Forms\Components\TextInput::make('usage')
                    ->maxLength(100),
                Forms\Components\DatePicker::make('dateMiseEnCirculation'),
                Forms\Components\TextInput::make('pn_ps')
                    ->maxLength(100),
                Forms\Components\TextInput::make('site')
                    ->maxLength(100),
                Forms\Components\Toggle::make('active')
                    ->required(),
                Forms\Components\TextInput::make('type_desactive')
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numchassis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matricule')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matriculeWW')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matriculeSTCR')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marque')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modele')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacite')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('station_autorise1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('station_autorise2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('affectation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ville')
                    ->searchable(),
                Tables\Columns\TextColumn::make('societe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('usage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dateMiseEnCirculation')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pn_ps')
                    ->searchable(),
                Tables\Columns\TextColumn::make('site')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('type_desactive')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicules::route('/'),
            'create' => Pages\CreateVehicule::route('/create'),
            'view' => Pages\ViewVehicule::route('/{record}'),
            'edit' => Pages\EditVehicule::route('/{record}/edit'),
        ];
    }
}
