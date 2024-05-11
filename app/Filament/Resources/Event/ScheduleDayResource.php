<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\ScheduleDayResource\Pages;
use App\Filament\Resources\Event\ScheduleDayResource\RelationManagers;
use App\Models\ScheduleDay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
            'index' => Pages\ListScheduleDays::route('/'),
            'create' => Pages\CreateScheduleDay::route('/create'),
            'edit' => Pages\EditScheduleDay::route('/{record}/edit'),
        ];
    }
}
