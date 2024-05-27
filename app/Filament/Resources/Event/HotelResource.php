<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\HotelResource\Pages;
use App\Filament\Resources\Event\HotelResource\RelationManagers;
use App\Models\Hotel;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Hoteles';
    protected static ?string $breadcrumb = 'Hoteles';
    protected static ?string $modelLabel = 'hotel';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 19;

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
                        TextInput::make('name')->label('Nombre')->required()->columnSpan(8),
                        TextInput::make('stars')->numeric()->label('Estrellas')->required()->columnSpan(4),
                        RichEditor::make('description')->required()->columnSpanFull(),
                        FileUpload::make('photo')->label('Foto')->disk('web')->required()->columnSpanFull(),
                        \Filament\Forms\Components\Builder::make('social_networks')->label('Redes sociales')->blockPickerColumns(3)
                            ->blocks([
                                Block::make('facebook')->label('Facebook')->schema([
                                    TextInput::make('url')->label('URL')->columnSpanFull(),
                                ]),
                                Block::make('x')->label('Twitter X')->schema([
                                    TextInput::make('url')->label('URL')->columnSpanFull(),
                                ]),
                                Block::make('web')->label('Web')->schema([
                                    TextInput::make('url')->label('URL')->columnSpanFull(),
                                ]),
                                Block::make('instagram')->label('Instagram')->schema([
                                    TextInput::make('url')->label('URL')->columnSpanFull(),
                                ]),
                                Block::make('linkedin')->label('Linkedin')->schema([
                                    TextInput::make('url')->label('URL')->columnSpanFull(),
                                ]),
                            ])->columnSpanFull(),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre'),
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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
