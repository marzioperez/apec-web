<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\SpeakerResource\Pages;
use App\Filament\Resources\Event\SpeakerResource\RelationManagers;
use App\Models\Speaker;
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

class SpeakerResource extends Resource {

    protected static ?string $model = Speaker::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Expositores';
    protected static ?string $breadcrumb = 'Expositores';
    protected static ?string $modelLabel = 'expositor';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Section::make([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('name')->label('Nombre')->required()->columnSpan(4),
                        TextInput::make('position')->label('Cargo')->required()->columnSpan(4),
                        TextInput::make('company')->label('Empresa')->required()->columnSpan(4),
                        Textarea::make('summary')->label('Resumen')->required()->columnSpanFull(),
                        RichEditor::make('biography')->required()->columnSpanFull(),
                        FileUpload::make('photo')->label('Foto')->disk('web')->required()->columnSpanFull(),
                        Builder::make('social_networks')->label('Redes sociales')->blockPickerColumns(3)
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

    public static function table(Table $table): Table {
        return $table
            ->modifyQueryUsing(fn(\Illuminate\Database\Eloquent\Builder $query) => $query->orderBy('order'))
            ->reorderable('order')
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable(),
                TextColumn::make('company')->label('Empresa')->searchable(),
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
            'index' => Pages\ListSpeakers::route('/'),
            'create' => Pages\CreateSpeaker::route('/create'),
            'edit' => Pages\EditSpeaker::route('/{record}/edit'),
        ];
    }
}
