<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\ScheduleCategoryResource\Pages;
use App\Filament\Resources\Event\ScheduleCategoryResource\RelationManagers;
use App\Models\ScheduleCategory;
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

class ScheduleCategoryResource extends Resource
{
    protected static ?string $model = ScheduleCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Programa';
    protected static ?string $navigationLabel = 'Grupo de fechas';
    protected static ?string $breadcrumb = 'Grupo de fechas';
    protected static ?string $modelLabel = 'grupo';
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
                        TextInput::make('name')->label('Nombre')->required()->columnSpanFull()
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
                TextColumn::make('name')->label('Nombre')
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
            'index' => Pages\ListScheduleCategories::route('/'),
            'create' => Pages\CreateScheduleCategory::route('/create'),
            'edit' => Pages\EditScheduleCategory::route('/{record}/edit'),
        ];
    }
}
