<?php

namespace App\Filament\Resources\Event;

use App\Concerns\Enums\Status;
use App\Filament\Resources\Event\UserResource\Pages;
use App\Filament\Resources\Event\UserResource\RelationManagers;
use App\Mail\RegisterDeclined;
use App\Mail\RegisterSuccess;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class UserResource extends Resource {

    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $breadcrumb = 'Usuarios';
    protected static ?string $modelLabel = 'usuario';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 12;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->tabs([
                    Tab::make('Información personal')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('name')->label('Nombre')->columnSpan(3)->required(),
                            TextInput::make('last_name')->label('Apellidos')->columnSpan(3)->required(),
                            TextInput::make('email')->label('Correo electrónico')->columnSpan(6)->required()
                                ->unique('users', 'email', ignoreRecord: true),

                            TextInput::make('business')->label('Negocio')->columnSpan(3)->required(),
                            TextInput::make('economy')->label('Economía')->columnSpan(3)->required(),
                            TextInput::make('business_description')->label('Descripción de negocio')->columnSpan(6)->required(),
                            TextInput::make('role')->label('Rol')->columnSpan(8)->required(),
                            TextInput::make('phone')->label('Teléfono')->columnSpan(4)->required(),
                            Textarea::make('biography')->label('Negocio')->columnSpanFull()->required(),

                        ])
                    ]),
                    Tab::make('Información de participante')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('attendee_name')->label('Nombre')->columnSpan(6),
                            TextInput::make('attendee_email')->label('Correo electrónico')->columnSpan(6),
                        ])
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array {
        return $page->generateNavigationItems([

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombres')->searchable(),
                TextColumn::make('last_name')->label('Apellidos')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('status')->label('Estado')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Status::CONFIRMED->value => 'success',
                        Status::PENDING_APPROVAL->value => 'warning',
                        Status::DECLINED->value => 'danger',
                        default => 'primary'
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('confirm')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->label('Confirmar')
                        ->requiresConfirmation()
                        ->modalHeading('¿Confirmar registro?')
                        ->modalDescription('Una vez que se confirme el registro del usuario, se le enviará un mensaje de forma automática con sus datos de acceso. Por favor confirme esta acción.')
                        ->modalSubmitActionLabel('Confirmar')
                        ->action(function (User $user):void {
                            $user->update(['status' => Status::CONFIRMED->value]);
                            Mail::to($user['email'])->send(new RegisterSuccess($user));
                        })->visible(fn(User $user): bool => $user['status'] === Status::PENDING_APPROVAL->value),
                    Tables\Actions\Action::make('decline')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->label('Rechazar')
                        ->requiresConfirmation()
                        ->modalHeading('¿Rechazar registro?')
                        ->modalDescription('Una vez que se rechace el registro del usuario, se le enviará un mensaje de forma automática agradeciendo su registro. Por favor confirme esta acción.')
                        ->modalSubmitActionLabel('Rechazar')
                        ->action(function (User $user):void {
                            $user->update(['status' => Status::DECLINED->value]);
                            Mail::to($user['email'])->send(new RegisterDeclined($user));
                        })->visible(fn(User $user): bool => $user['status'] === Status::PENDING_APPROVAL->value),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}