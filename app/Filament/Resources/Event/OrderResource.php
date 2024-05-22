<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\OrderResource\Pages;
use App\Filament\Resources\Event\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pedidos';
    protected static ?string $breadcrumb = 'Pedidos';
    protected static ?string $modelLabel = 'pedido';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 18;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->searchable()->label('Nombre'),
                TextColumn::make('user.last_name')->searchable()->label('Apellidos'),
                TextColumn::make('payment_method')->searchable()->label('Método de pago'),
                TextColumn::make('status')->searchable()->label('Estado')->badge(),
                TextColumn::make('created_at')->date('d/m/Y H:i')->label('Fecha de registro'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->label('Ver'),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}