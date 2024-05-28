<?php

namespace App\Filament\Resources\Event\ScheduleDayResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'activities';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->schema([
                    TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                    TimePicker::make('start')->label('Inicio')->columnSpan(6)->required(),
                    TimePicker::make('end')->label('Fin')->columnSpan(6)->required(),
                    RichEditor::make('content')->label('Contenido')->required()->columnSpanFull(),
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order'))
            ->reorderable('order')
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')->label('Título'),
                TextColumn::make('start')->label('Inicio'),
                TextColumn::make('end')->label('Fin'),
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
