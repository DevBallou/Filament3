<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\SqaReclamationResource\Pages;
use App\Filament\App\Resources\SqaReclamationResource\RelationManagers;
use App\Models\Client;
use App\Models\FluxType;
use App\Models\SqaReclamation;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class SqaReclamationResource extends Resource
{
    protected static ?string $model = SqaReclamation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Secteur d\'Activité')
                    // ->description('Ici vous pouvez mettre secteur d\'activité pour obtenir des clients')
                    ->schema([
                        Forms\Components\Select::make('secteur_activite_id')
                            ->relationship(name: 'secteurActivite', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('client_id', null))
                            ->required(),
                        Forms\Components\Select::make('client_id')
                            ->options(
                                fn (Get $get): Collection => Client::query()
                                    ->where('secteur_activite_id', $get('secteur_activite_id'))
                                    ->pluck('nom', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                    ])->columns(2),
                Section::make('Type de réclamation')
                    // ->description('Ici vous pouvez mettre flux pour obtenir des types de réclamation')
                    ->schema([
                        Forms\Components\Select::make('flux_id')
                            ->relationship(name: 'flux', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('flux_type_id', null))
                            ->required(),
                        Forms\Components\Select::make('flux_type_id')
                            ->options(
                                fn (Get $get): Collection => FluxType::query()
                                    ->where('flux_id', $get('flux_id'))
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                    ])->columns(2),
                Section::make('Véhicule & Chauffeur')
                    // ->description('Ici vous pouvez mettre véhicule pour obtenir chauffeur')
                    ->schema([
                        Forms\Components\Select::make('vehicule_matricule')
                            ->relationship(name: 'vehicule', titleAttribute: 'matricule')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('chauffeur_mat')
                            ->relationship(name: 'chauffeur', titleAttribute: 'full_name')
                            ->searchable()
                            ->preload(),
                    ])->columns(2),
                Section::make('Mouvement')
                    // ->description('Ici vous pouvez mettre horaire et mouvement')
                    ->schema([
                        Forms\Components\TimePicker::make('horaire')
                            ->seconds(false)
                            ->timezone('Africa/Casablanca'),
                        Forms\Components\Select::make('mouvement')
                            ->options([
                                'E' => 'Entrée',
                                'S' => 'Sortie',
                            ])
                    ])->columns(2),
                Forms\Components\Textarea::make('detail')
                    ->autosize(),
                Forms\Components\Hidden::make('moderateur_id')->dehydrateStateUsing(fn ($state) => Auth::id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->date()
                    ->label('créé à')
                    ->sortable()
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->weight(FontWeight::Thin)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('secteurActivite.name')
                    ->label('Secteur')
                    ->searchable()
                    ->wrap()
                    ->fontFamily(FontFamily::Mono)
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->weight(FontWeight::Thin),
                TextColumn::make('client.nom')
                    ->searchable()
                    ->wrap()
                    ->fontFamily(FontFamily::Mono)
                    ->size(TextColumn\TextColumnSize::ExtraSmall),
                TextColumn::make('flux.name')->size(TextColumn\TextColumnSize::ExtraSmall),
                TextColumn::make('fluxType.name')->size(TextColumn\TextColumnSize::ExtraSmall),
                TextColumn::make('vehicule.matricule')->label('Véhicule')->searchable()->size(TextColumn\TextColumnSize::ExtraSmall),
                TextColumn::make('chauffeur.full_name')->searchable()->wrap()->size(TextColumn\TextColumnSize::ExtraSmall),
                TextColumn::make('mouvement')
                    ->description(fn (SqaReclamation $sqa): string => Carbon::createFromFormat('H:i:s', $sqa->horaire)->format('H:i'), position: 'right')
                    ->size(TextColumn\TextColumnSize::ExtraSmall),
                TextColumn::make('detail')
                    ->wrap()
                    ->fontFamily(FontFamily::Mono)
                    ->size(TextColumn\TextColumnSize::ExtraSmall),
                TextColumn::make('updated_at')
                    ->label('mis à jour à')
                    ->since()
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->weight(FontWeight::Thin)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at')
            // ->filters([
            //     SelectFilter::make('SecteurActivite')
            //         ->relationship('secteurActivite', 'name')
            //         ->searchable()
            //         ->preload()
            //         ->label('filtrez par secteur d\'activite')
            //         ->indicator('Secteur'),
            //     Filter::make('created_at')
            //         ->form([
            //             DatePicker::make('created_from'),
            //             DatePicker::make('created_until'),
            //         ])
            //         ->query(function (Builder $query, array $data): Builder {
            //             return $query
            //                 ->when(
            //                     $data['created_from'],
            //                     fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            //                 )
            //                 ->when(
            //                     $data['created_until'],
            //                     fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
            //                 );
            //         })
            //         ->indicateUsing(function (array $data): array {
            //             $indicators = [];

            //             if ($data['created_from'] ?? null) {
            //                 $indicators['created_from'] = 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
            //             }

            //             if ($data['created_until'] ?? null) {
            //                 $indicators['created_until'] = 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
            //             }

            //             return $indicators;
            //         })
            // ])
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ComponentsSection::make('S.Q.A Info')
                    ->schema([
                        TextEntry::make('secteurActivite.name'),
                        TextEntry::make('client.nom'),
                        TextEntry::make('flux.name'),
                        TextEntry::make('fluxType.name'),
                        TextEntry::make('vehicule.matricule'),
                        TextEntry::make('chauffeur.full_name'),
                    ])->columns(2)
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
            'index' => Pages\ListSqaReclamations::route('/'),
            'create' => Pages\CreateSqaReclamation::route('/create'),
            'view' => Pages\ViewSqaReclamation::route('/{record}'),
            'edit' => Pages\EditSqaReclamation::route('/{record}/edit'),
        ];
    }
}
