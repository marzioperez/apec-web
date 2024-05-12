<?php

namespace App\Filament\Resources\Event;

use App\Concerns\Enums\Status;
use App\Filament\Resources\Event\ConfirmedUserResource\Pages;
use App\Filament\Resources\Event\ConfirmedUserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConfirmedUserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Usuarios';
    protected static ?string $navigationLabel = 'Usuarios confirmados';
    protected static ?string $breadcrumb = 'Usuarios confirmados';
    protected static ?string $modelLabel = 'usuario';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 13;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) =>
                $query->where('status', Status::CONFIRMED->value)
            )
            ->columns([
                TextColumn::make('full_name')->label('Nombres y Apellidos'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('register_progress')->label('Progreso')->badge()->color('info')->suffix('%'),
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
            'index' => Pages\ListConfirmedUsers::route('/'),
            'create' => Pages\CreateConfirmedUser::route('/create'),
            'edit' => Pages\EditConfirmedUser::route('/{record}/edit'),
        ];
    }
}
