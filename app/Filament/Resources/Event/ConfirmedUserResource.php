<?php

namespace App\Filament\Resources\Event;

use App\Concerns\Enums\Status;
use App\Concerns\Enums\Titles;
use App\Filament\Resources\Event\ConfirmedUserResource\Pages;
use App\Filament\Resources\Event\ConfirmedUserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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
                Tabs::make()->tabs([
                    Tab::make('Información general')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            Select::make('title')->label('Título')->options([
                                Titles::MR->value => Titles::MR->value,
                                Titles::MRS->value => Titles::MRS->value,
                                Titles::MS->value => Titles::MS->value,
                                Titles::DR->value => Titles::DR->value
                            ])->columnSpan(2)
                        ])
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) =>
                $query->where('status', Status::CONFIRMED->value)
            )
            ->columns([
                TextColumn::make('name')->label('Nombres')->searchable(),
                TextColumn::make('last_name')->label('Apellidos')->searchable(),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('register_progress')->label('Progreso')->badge()->color('info')->suffix('%'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
