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
                        Builder::make('content')->blockPickerColumns(2)->label('Bloques')
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
                                    ]),
                                    TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                ]),
                                Block::make('progress')->label('Barra de progreso')->schema([
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
                                        TextInput::make('url')->label('URL')->columnSpan(8),
                                        TextInput::make('id')->label('ID para ancla')->columnSpanFull()
                                    ])
                                ]),
                                Block::make('block-1')->label('Bloque de texto con libro')->schema([
                                    Tabs::make()->tabs([
                                        Tab::make('Contenido')->schema([
                                            Grid::make([
                                                'default' => 1,
                                                'sm' => 3,
                                                'xl' => 12,
                                                '2xl' => 12
                                            ])->schema([
                                                TextInput::make('title')->label('Título')->columnSpanFull(),
                                                TextInput::make('sub_title')->label('Sub título')->columnSpanFull(),
                                                RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                                                TextInput::make('text_button')->label('Texto de botón')->columnSpanFull(),
                                                FileUpload::make('preview')->disk('web')->label('Imagen')->preserveFilenames()->image()->required()->columnSpanFull()
                                            ])
                                        ]),
                                        Tab::make('Imágenes libro')->schema([
                                            Repeater::make('images')->schema([
                                                FileUpload::make('image')->disk('web')->label('Imagen')->preserveFilenames()->image()->required()->columnSpanFull()
                                            ])->reorderable()->columnSpan(2),
                                        ]),
                                        Tab::make('Embed')->schema([
                                            Forms\Components\Textarea::make('embed')->label('Video embed')->columnSpanFull()
                                        ])
                                    ]),
                                    TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                ]),
                                Block::make('block-2')->label('Bloque de texto con imagen y popup')->schema([
                                    Tabs::make()->tabs([
                                        Tab::make('Contenido')->schema([
                                            Grid::make([
                                                'default' => 1,
                                                'sm' => 3,
                                                'xl' => 12,
                                                '2xl' => 12
                                            ])->schema([
                                                TextInput::make('title')->label('Título')->columnSpanFull(),
                                                TextInput::make('sub_title')->label('Sub título')->columnSpanFull(),
                                                RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                                                TextInput::make('text_button')->label('Texto de botón')->columnSpanFull(),
                                                FileUpload::make('image')->disk('web')->label('Imagen')->preserveFilenames()->image()->required()->columnSpanFull()
                                            ])
                                        ]),
                                        Tab::make('Popup')->schema([
                                            TextInput::make('pop_up_title')->label('Título')->columnSpanFull(),
                                            RichEditor::make('pop_up_content')->label('Contenido')->columnSpanFull(),
                                            FileUpload::make('pop_up_image')->disk('web')->label('Imagen')->preserveFilenames()->image()->required()->columnSpanFull()
                                        ])
                                    ]),
                                    TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                ]),
                                Block::make('program')->label('Bloque de programa')->schema([
                                    Tabs::make()->tabs([
                                        Tab::make('Contenido')->schema([
                                            TextInput::make('title')->label('Título')->columnSpanFull(),
                                            TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                        ]),
                                        Tab::make('Archivo')->schema([
                                            FileUpload::make('file')->label('Archivo PDF')->preserveFilenames()->disk('web')->columnSpanFull(),
                                            TextInput::make('text_button')->label('Texto de botón')->columnSpanFull(),
                                        ]),
                                    ])
                                ]),
                                Block::make('speakers')->label('Bloque de expositores')->schema([
                                    TextInput::make('title')->label('Título')->columnSpanFull(),
                                    TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                ]),
                                Block::make('circular-progress')->label('Círculo de progreso')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        TextInput::make('title')->label('Título')->columnSpanFull(),
                                        TextInput::make('sub_title')->label('Sub título')->columnSpanFull(),
                                        TextInput::make('text_button')->label('Texto de botón')->columnSpan(4),
                                        TextInput::make('url')->label('URL')->columnSpan(8),
                                        TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('hotels')->label('Bloque de hoteles')->schema([
                                    TextInput::make('title')->label('Título')->columnSpanFull(),
                                    TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                ]),
                                Block::make('sponsors')->label('Bloque de sponsors')->schema([
                                    TextInput::make('title')->label('Título')->columnSpanFull(),
                                    TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                ]),
                                Block::make('news')->label('Bloque de noticias')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        TextInput::make('title')->label('Título')->columnSpan(8),
                                        TextInput::make('text_button')->label('Texto de botón')->columnSpan(4),
                                        TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('block-3')->label('Bloque de textos en columnas')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        TextInput::make('title')->label('Título')->columnSpan(8),
                                        TextInput::make('columns')->label('Columnas')->numeric()->columnSpan(4),
                                        Repeater::make('elementos')->label('Textos')->schema([
                                            RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                                        ])->columnSpanFull(),
                                        TextInput::make('id')->label('ID para ancla')->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('name')->label('Nombre'),
            ])
            ->filters([
                //
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
