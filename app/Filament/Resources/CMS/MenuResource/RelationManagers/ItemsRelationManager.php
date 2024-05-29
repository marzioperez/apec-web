<?php

namespace App\Filament\Resources\CMS\MenuResource\RelationManagers;

use App\Concerns\Enums\Types;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->schema([
                    TextInput::make('name')->required()->label('Nombre')->columnSpan(8),
                    Select::make('type')->required()->label('Tipo')->columnSpan(4)->options([
                        Types::ANCHOR->value => Types::ANCHOR->value,
                        Types::URL->value => Types::URL->value
                    ]),
                    TextInput::make('url')->required()->label('Valor')->columnSpan(6),
                    Toggle::make('only_logged')->inline(false)->label('Mostrar solo para usuarios registrados')->columnSpan(6)
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order', 'ASC'))
            ->reorderable('order')
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
