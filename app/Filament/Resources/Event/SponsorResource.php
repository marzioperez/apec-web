<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\SponsorResource\Pages;
use App\Filament\Resources\Event\SponsorResource\RelationManagers;
use App\Models\CategorySponsor;
use App\Models\Sponsor;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
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

class SponsorResource extends Resource {

    protected static ?string $model = Sponsor::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Sponsors';
    protected static ?string $breadcrumb = 'Sponsors';
    protected static ?string $modelLabel = 'sponsor';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 11;

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
                        Select::make('category_sponsor_id')->label('Categoría')->options(CategorySponsor::all()->pluck('name', 'id'))->columnSpan(4),
                        RichEditor::make('description')->required()->columnSpanFull(),
                        FileUpload::make('logo')->label('Logo')->disk('web')->preserveFilenames()->required()->columnSpanFull(),
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
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order'))
            ->reorderable('order')
            ->columns([
                TextColumn::make('name')->label('Nombre'),
                TextColumn::make('category.name')->label('Categoría'),
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
            'index' => Pages\ListSponsors::route('/'),
            'create' => Pages\CreateSponsor::route('/create'),
            'edit' => Pages\EditSponsor::route('/{record}/edit'),
        ];
    }
}
