<?php

namespace App\Filament\Resources\CMS;

use App\Filament\Resources\CMS\PageResource\Pages;
use App\Filament\Resources\CMS\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource {

    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Páginas';
    protected static ?string $breadcrumb = 'Páginas';
    protected static ?string $modelLabel = 'página';
    protected static ?string $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 21;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->schema([
                    Section::make('Bloques')->compact()->schema([
                        Builder::make('content')->blockPickerColumns(3)->label('Bloques')
                            ->blocks([
                                Block::make('banner')->label('Banner con texto')->schema([
                                    Tabs::make()->tabs([
                                        Tab::make('Contenido')->schema([
                                            Grid::make([
                                                'default' => 1,
                                                'sm' => 3,
                                                'xl' => 12,
                                                '2xl' => 12
                                            ])->schema([
                                                FileUpload::make('logo')->disk('web')->label('Logo')->preserveFilenames()->image()->required()->columnSpanFull(),
                                                DatePicker::make('counter_date')->label('Fecha cuenta regresiva')->native(false)->columnSpanFull(),
                                                RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                                                TextInput::make('text_button')->label('Texto de botón')->columnSpan(4),
                                                TextInput::make('url')->label('URL')->columnSpan(8)
                                            ])
                                        ]),
                                        Tab::make('Imágenes')->schema([
                                            Repeater::make('images')->schema([
                                                FileUpload::make('image')->disk('web')->label('Imagen')->preserveFilenames()->image()->required()->columnSpanFull()
                                            ])->reorderable()->columnSpan(2),
                                        ])
                                    ])
                                ]),
                                Block::make('progress')->label('Banner de progreso')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        TextInput::make('title')->label('Título')->columnSpanFull(),
                                        TextInput::make('sub_title')->label('Sub título')->columnSpanFull()
                                            ->hintIcon('heroicon-m-question-mark-circle', 'Usar #progress# para colocar el progreso del usuario.'),
                                        TextInput::make('text_button')->label('Texto de botón')->columnSpan(4),
                                        TextInput::make('url')->label('URL')->columnSpan(8)
                                    ])
                                ]),
                            ])->collapsed()->cloneable(),
                    ])->columnSpan(8),
                    Section::make('Ajustes')->schema([
                        TextInput::make('name')->label('Nombre')->columnSpanFull()->required(),
                        Toggle::make('is_home')->label('¿Página de inicio?')
                    ])->columnSpan(4)
                ])
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
