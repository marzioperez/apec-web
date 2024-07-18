<?php

namespace App\Filament\Resources\Event;

use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Filament\Resources\Event\UserResource\Pages;
use App\Filament\Resources\Event\UserResource\RelationManagers;
use App\Mail\RegisterDeclined;
use App\Mail\RegisterSuccess;
use App\Models\Economy;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserResource extends Resource {

    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $breadcrumb = 'Usuarios';
    protected static ?string $modelLabel = 'usuario';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 12;


    public static function form(Form $form): Form {
        $economies = Economy::all();
        $economies_items = [];
        foreach ($economies as $economie) {
            $economies_items[$economie->id] = $economie->name;
        }
        $economies_items[] = ['other' => 'Otra economía'];

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
                            TextInput::make('name')->label('Nombre')->columnSpan(6)->required(),
                            TextInput::make('last_name')->label('Apellidos')->columnSpan(6)->required(),
                            TextInput::make('phone')->label('Celular')->columnSpan(6)->required(),
                            TextInput::make('email')->label('Correo electrónico')->columnSpan(6)->required()
                                ->unique('users', 'email', ignoreRecord: true),
                            TextInput::make('business')->label('Negocio')->columnSpan(4),
                            Select::make('economy')->options($economies_items)->label('Economía')->columnSpan(4),
                            TextInput::make('other_economy')->label('Otra economía')->columnSpan(4),
                            TextInput::make('role')->label('Rol')->columnSpan(4),
                            Select::make('type')->label('Tipo')->options([
                                Types::PARTICIPANT->value => Types::PARTICIPANT->value,
                                Types::STAFF->value => Types::STAFF->value,
                                Types::COMPANION->value => Types::COMPANION->value,
                                Types::FREE_PASS_PARTICIPANT->value => Types::FREE_PASS_PARTICIPANT->value,
                                Types::FREE_PASS_STAFF->value => Types::FREE_PASS_STAFF->value,
                                Types::FREE_PASS_COMPANION->value => Types::FREE_PASS_COMPANION->value,
                                Types::VIP->value => Types::VIP->value
                            ])->required()->columnSpan(4),
                            TextInput::make('amount')->label('Monto a pagar')->numeric()->columnSpan(4)->required(),

                            Forms\Components\Section::make()->schema([
                                Grid::make([
                                    'default' => 1,
                                    'sm' => 3,
                                    'xl' => 12,
                                    '2xl' => 12
                                ])->schema([
                                    TextInput::make('companion_amount')->label('Monto acompañante')->readOnly()->numeric()->columnSpan(6),
                                    TextInput::make('staff_amount')->label('Monto Staffer')->readOnly()->numeric()->columnSpan(6),
                                ])
                            ])->columnSpanFull(),

                            Textarea::make('business_description')->label('Descripción de negocio')->columnSpanFull(),
                            Textarea::make('biography')->label('Biografía')->columnSpanFull(),

                        ])
                    ]),
                    Tab::make('Información de asistente')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('attendee_name')->label('Nombre')->columnSpan(6),
                            TextInput::make('attendee_email')->label('Correo electrónico')->columnSpan(6),
                        ])
                    ])->hidden()
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
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')->label('Nombres')->searchable()->sortable(),
                TextColumn::make('last_name')->label('Apellidos')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable()->sortable(),
                TextColumn::make('type')->label('Tipo')->sortable(),
                TextColumn::make('rel_economy.name')->label('Economía')->sortable(),
                TextColumn::make('created_at')->label('Fecha de registro')->date('d/m/Y H:i')->sortable(),
                TextColumn::make('status')->label('Estado')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Status::CONFIRMED->value => 'success',
                        Status::PENDING_APPROVAL->value => 'warning',
                        Status::DECLINED->value => 'danger',
                        default => 'primary'
                    }),
            ])
            ->filters([
                SelectFilter::make('type')->label('Tipo')
                    ->multiple()
                    ->options([
                        Types::PARTICIPANT->value => Types::PARTICIPANT->value,
                        Types::COMPANION->value => Types::COMPANION->value,
                        Types::STAFF->value => Types::STAFF->value,
                        Types::FREE_PASS_PARTICIPANT->value => Types::FREE_PASS_PARTICIPANT->value,
                        Types::FREE_PASS_COMPANION->value => Types::FREE_PASS_COMPANION->value,
                        Types::FREE_PASS_STAFF->value => Types::FREE_PASS_STAFF->value,
                        Types::VIP->value => Types::VIP->value,
                        Types::STAFF_CP->value => Types::STAFF_CP->value,
                        Types::SUPPLIER->value => Types::SUPPLIER->value,
                        Types::PERSONAL_SECURITY->value => Types::PERSONAL_SECURITY->value,
                        Types::SECURITY->value => Types::SECURITY->value,
                        Types::LIAISON->value => Types::LIAISON->value,
                        Types::EXHIBITOR->value => Types::EXHIBITOR->value,
                    ]),
                SelectFilter::make('economy')->label('Economía')
                    ->multiple()
                    ->options(Economy::all()->pluck('name', 'id')),
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
                            $new_password = Str::slug($user['phone']);
                            $user->update([
                                'status' => Status::CONFIRMED->value,
                                'password' => $new_password
                            ]);
                            Mail::to($user['email'])->send(new RegisterSuccess($user, $new_password));
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
