<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\CategorySponsorResource\Pages;
use App\Filament\Resources\Event\CategorySponsorResource\RelationManagers;
use App\Models\CategorySponsor;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategorySponsorResource extends Resource {

    protected static ?string $model = CategorySponsor::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Sponsors';
    protected static ?string $navigationLabel = 'Categoría de sponsors';
    protected static ?string $breadcrumb = 'Categoría de sponsors';
    protected static ?string $modelLabel = 'categoría';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('name')->label('Nombre')->required()->columnSpanFull(),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order'))
            ->reorderable('order')
            ->columns([
                TextColumn::make('name')->label('Nombre'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
