<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\ScheduleDayResource\Pages;
use App\Filament\Resources\Event\ScheduleDayResource\RelationManagers;
use App\Models\ScheduleCategory;
use App\Models\ScheduleDay;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleDayResource extends Resource {

    protected static ?string $model = ScheduleDay::class;
    protected static ?string $navigationIcon = 'heroicon-c-calendar-days';
    protected static ?string $navigationLabel = 'Programa';
    protected static ?string $breadcrumb = 'Programa';
    protected static ?string $modelLabel = 'programa';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 8;


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
                        TextInput::make('title')->label('Título')->required()->columnSpan(6),
                        Select::make('schedule_category_id')->label('Categoría')->options(ScheduleCategory::all()->pluck('name', 'id'))->required()->columnSpan(6),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(\Illuminate\Database\Eloquent\Builder $query) => $query->orderBy('order'))
            ->reorderable('order')
            ->columns([
                TextColumn::make('title')->label('Título')
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
            RelationManagers\ActivitiesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScheduleDays::route('/'),
            'create' => Pages\CreateScheduleDay::route('/create'),
            'edit' => Pages\EditScheduleDay::route('/{record}/edit'),
        ];
    }
}
