<?php

namespace App\Filament\Resources\CMS;

use App\Filament\Resources\CMS\FequentlyAskedQuestionResource\Pages;
use App\Filament\Resources\CMS\FequentlyAskedQuestionResource\RelationManagers;
use App\Models\FequentlyAskedQuestion;
use Filament\Forms;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FequentlyAskedQuestionResource extends Resource
{
    protected static ?string $model = FequentlyAskedQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'FAQ';
    protected static ?string $breadcrumb = 'FAQ';
    protected static ?string $modelLabel = 'pregunta frecuente';
    protected static ?string $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 24;

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
                        TextInput::make('question')->label('Pregunta')->required()->columnSpanFull(),
                        RichEditor::make('answer')->label('Respuesta')->required()->columnSpanFull()
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
                TextColumn::make('question')->label('Pregunta')
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
            'index' => Pages\ListFequentlyAskedQuestions::route('/'),
            'create' => Pages\CreateFequentlyAskedQuestion::route('/create'),
            'edit' => Pages\EditFequentlyAskedQuestion::route('/{record}/edit'),
        ];
    }
}
