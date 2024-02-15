<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SecteurActiviteResource\Pages;
use App\Filament\Resources\SecteurActiviteResource\RelationManagers;
use App\Filament\Resources\SecteurActiviteResource\RelationManagers\ClientsRelationManager;
use App\Models\SecteurActivite;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SecteurActiviteResource extends Resource
{
    protected static ?string $model = SecteurActivite::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Secteur';

    protected static ?string $modelLabel = 'Secteur d\'activité de Client';

    protected static ?string $navigationGroup = 'Gestion du Client';

    protected static ?int $navigationSort = 1;

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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            ClientsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSecteurActivites::route('/'),
            'create' => Pages\CreateSecteurActivite::route('/create'),
            'edit' => Pages\EditSecteurActivite::route('/{record}/edit'),
        ];
    }
}
