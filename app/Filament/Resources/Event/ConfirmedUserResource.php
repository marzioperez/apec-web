<?php

namespace App\Filament\Resources\Event;

use App\Concerns\Enums\Genders;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Titles;
use App\Concerns\Enums\Types;
use App\Filament\Resources\Event\ConfirmedUserResource\Pages;
use App\Filament\Resources\Event\ConfirmedUserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                            ])->columnSpan(2),
                            TextInput::make('name')->label('Nombre')->required()->columnSpan(5),
                            TextInput::make('last_name')->label('Apellidos')->required()->columnSpan(5),
                            Select::make('gender')->label('Sexo')->options([
                                Genders::MALE->value => Genders::MALE->value,
                                Genders::FEMALE->value => Genders::FEMALE->value
                            ])->columnSpan(3),
                            Select::make('document_type')->label('Tipo de documento')->options([
                                Types::DNI->value => Types::DNI->value,
                                Types::PASSPORT->value => Types::PASSPORT->value,
                                Types::CE->value => Types::CE->value
                            ])->columnSpan(3),
                            TextInput::make('document_number')->label('Número de documento')->required()->columnSpan(3),
                            TextInput::make('email')->label('Email')->required()
                                ->unique('users', 'email', ignoreRecord: true)->columnSpan(3),
                            DatePicker::make('date_of_issue')->label('Fecha de emisión')->columnSpan(3),
                            TextInput::make('date_of_issue')->label('Lugar de emisión')->columnSpan(3),
                            DatePicker::make('date_of_birth')->label('Fecha de nacimiento')->columnSpan(3),
                            TextInput::make('nationality')->label('Nacionalidad')->columnSpan(3),
                            TextInput::make('city_of_permanent_residency')->label('Ciudad de residencia')->columnSpan(4),
                            Select::make('type')->label('Tipo')->options([
                                Types::COMPANION->value => Types::COMPANION->value,
                                Types::STAFF->value => Types::STAFF->value,
                                Types::FREE_PASS_COMPANION->value => Types::FREE_PASS_COMPANION->value,
                                Types::FREE_PASS_STAFF->value => Types::FREE_PASS_STAFF->value,
                            ])->required()->columnSpan(4),
                            TextInput::make('amount')->label('Monto a pagar')->numeric()->columnSpan(4)->required(),
                        ])
                    ]),
                    Tab::make('Información de la empresa')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('business')->label('Empresa')->required()->columnSpan(4),
                            TextInput::make('role')->label('Rol')->required()->columnSpan(4),
                            TextInput::make('area')->label('Área')->required()->columnSpan(4),
                            TextInput::make('address')->label('Dirección')->required()->columnSpan(12),
                            TextInput::make('city')->label('Ciudad')->required()->columnSpan(3),
                            TextInput::make('zip_code')->label('Código ZIP')->required()->columnSpan(2),
                            TextInput::make('business_phone_number')->label('Teléfono de empresa')->required()->columnSpan(3),
                            TextInput::make('business_email')->label('Email de empresa')->required()->columnSpan(4),
                            TextInput::make('attendee_name')->label('Nombre de asistente')->required()->columnSpan(6),
                            TextInput::make('attendee_email')->label('Email de asistente')->required()->columnSpan(6),
                        ])
                    ]),
                    Tab::make('Requisitos especiales')->schema([
                        Forms\Components\Section::make([
                            Select::make('types_of_food')->label('Tipo de dieta')->options([
                                'Vegetarian' => 'Vegetariana',
                                'Vegan' => 'Vegana',
                                'Kosher' => 'Comestible según la ley judía'
                            ])->columnSpanFull(),
                            Textarea::make('require_special_assistance')->label('¿Necesita alguna asistencia especial para participar?')->columnSpanFull()
                        ])->compact()->columnSpanFull(),
                        Repeater::make('guests')->relationship('guests')
                            ->label('Invitados')->addable(false)
                            ->schema([
                                Grid::make([
                                    'default' => 1,
                                    'sm' => 3,
                                    'xl' => 12,
                                    '2xl' => 12
                                ])->schema([
                                    TextInput::make('type')->label('Tipo')->required()->columnSpan(4)->disabled(),
                                    TextInput::make('name')->label('Nombre')->required()->columnSpan(4),
                                    TextInput::make('last_name')->label('Apellidos')->required()->columnSpan(4),
                                    TextInput::make('phone')->label('Nombre')->required()->columnSpan(6),
                                    TextInput::make('email')->label('Email')->required()->columnSpan(6)
                                ])
                            ])
                    ]),
                    Tab::make('Información médica')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            Select::make('blood_type')->label('Tipo de sangre')->required()
                                ->options([
                                    'A+' => 'A+',
                                    'O+' => 'O+',
                                    'B+' => 'B+',
                                    'AB+' => 'AB+',
                                    'A-' => 'A-',
                                    'O-' => 'O-',
                                    'B-' => 'B-',
                                    'AB-' => 'AB-'
                                ])->columnSpan(3),
                            Toggle::make('allergies')->inline(false)->label('Alergias')->required()->columnSpan(2),
                            Textarea::make('allergy_details')->label('Detalle')->required()->columnSpanFull(),
                            Forms\Components\CheckboxList::make('vaccines')->label('Vacunas')->columnSpanFull()
                                ->options([
                                    'COVID-19' => 'COVID-19',
                                    'Hepatitis A' => 'Hepatitis A',
                                    'Hepatitis B' => 'Hepatitis B',
                                    'Yellow fever' => 'Yellow fever',
                                ]),
                            Textarea::make('medical_others')->label('Otros')->required()->columnSpanFull(),
                            Toggle::make('medical_treatment')->inline(false)->label('Tratamiento médico')->required()->columnSpan(3),
                            Textarea::make('medical_treatment_details')->label('Detalle')->columnSpanFull(),
                            TextInput::make('taking_any_medication')->label('Toma alguna medicación')->columnSpanFull(),
                            TextInput::make('chemical_name')->label('Nombre químico')->columnSpan(3),
                            TextInput::make('brand_trade_name')->label('Marca')->columnSpan(3),
                            TextInput::make('dosis')->label('Dosis')->columnSpan(3),
                            TextInput::make('frequency')->label('Frecuencia')->columnSpan(3),

                            Forms\Components\Section::make('Información de doctor')->compact()->schema([
                                Grid::make([
                                    'default' => 1,
                                    'sm' => 3,
                                    'xl' => 12,
                                    '2xl' => 12
                                ])->schema([
                                    TextInput::make('dr_name')->label('Nombre')->columnSpan(6),
                                    TextInput::make('dr_last_name')->label('Apellidos')->columnSpan(6),
                                    TextInput::make('dr_number')->label('Teléfono')->columnSpan(6),
                                    TextInput::make('dr_email')->label('Email')->columnSpan(6),
                                ])
                            ]),

                            Forms\Components\Section::make('Información de seguros internacionales')->compact()->schema([
                                Grid::make([
                                    'default' => 1,
                                    'sm' => 3,
                                    'xl' => 12,
                                    '2xl' => 12
                                ])->schema([
                                    TextInput::make('insurance_company')->label('Empresa')->columnSpan(4),
                                    TextInput::make('insurance_id_number')->label('Número ID')->columnSpan(4),
                                    TextInput::make('insurance_phone')->label('Teléfono')->columnSpan(4),
                                    TextInput::make('insurance_other_specifications')->label('Otra especificaciones')->columnSpanFull(),
                                ])
                            ])

                        ])
                    ]),
                    Tab::make('Información de badge')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('badge_name')->label('Nombre')->required()->columnSpan(6),
                            TextInput::make('badge_last_name')->label('Apellidos')->required()->columnSpan(6),
                            Forms\Components\FileUpload::make('badge_photo')->label('Foto')->disk('badges')->required()->image()->downloadable()->columnSpanFull(),
                            Forms\Components\FileUpload::make('identity_document')->label('Documento de identidad')->disabled('ids')->required()->downloadable()->columnSpanFull(),
                        ])
                    ]),
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
                TextColumn::make('type')->label('Tipo'),
                TextColumn::make('register_progress')->label('Progreso')->badge()->color('info')->suffix('%'),
            ])
            ->filters([
                SelectFilter::make('type')->label('Tipo')
                    ->multiple()
                    ->options([
                        Types::COMPANION->value => Types::COMPANION->value,
                        Types::STAFF->value => Types::STAFF->value,
                        Types::FREE_PASS_COMPANION->value => Types::FREE_PASS_COMPANION->value,
                        Types::FREE_PASS_STAFF->value => Types::FREE_PASS_STAFF->value,
                        Types::VIP->value => Types::VIP->value,
                    ])
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
