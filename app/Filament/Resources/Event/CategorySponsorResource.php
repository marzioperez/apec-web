<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\CategorySponsorResource\Pages;
use App\Filament\Resources\Event\CategorySponsorResource\RelationManagers;
use App\Models\CategorySponsor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategorySponsorResource extends Resource {

    protected static ?string $model = CategorySponsor::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Expositores';
    protected static ?string $navigationLabel = 'Categoría de expositores';
    protected static ?string $breadcrumb = 'Categoría de expositores';
    protected static ?string $modelLabel = 'categoría';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorySponsors::route('/'),
            'create' => Pages\CreateCategorySponsor::route('/create'),
            'edit' => Pages\EditCategorySponsor::route('/{record}/edit'),
        ];
    }
}
