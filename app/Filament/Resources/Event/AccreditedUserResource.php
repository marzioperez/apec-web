<?php

namespace App\Filament\Resources\Event;

use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Filament\Resources\Event\AccreditedUserResource\Pages;
use App\Filament\Resources\Event\AccreditedUserResource\RelationManagers;
use App\Models\Economy;
use App\Models\Param;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use ValentinMorice\FilamentJsonColumn\FilamentJsonColumn;

class AccreditedUserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Usuarios';
    protected static ?string $navigationLabel = 'Usuarios acreditados';
    protected static ?string $breadcrumb = 'Usuarios acreditados';
    protected static ?string $modelLabel = 'usuario';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 15;

    public static function form(Form $form): Form {
        $params = Param::all();
        $titles = [];
        $genders = [];
        $document_types = [];
        foreach ($params as $param) {
            if ($param['group'] === 'TITLES') {
                $titles[] = $param;
            }

            if ($param['group'] === 'GENDERS') {
                $genders[] = $param;
            }

            if ($param['group'] === 'DOCUMENTS') {
                $document_types[] = $param;
            }
        }
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
                            Select::make('title')->label('Título')->options(collect($titles)->pluck('name', 'id'))->columnSpan(2),
                            TextInput::make('name')->label('Nombre')->required()->columnSpan(4),
                            TextInput::make('last_name')->label('Apellidos')->required()->columnSpan(4),
                            Select::make('type')->label('Tipo')->options([
                                Types::PARTICIPANT->value => Types::PARTICIPANT->value,
                                Types::STAFF->value => Types::STAFF->value,
                                Types::COMPANION->value => Types::COMPANION->value,
                                Types::FREE_PASS_PARTICIPANT->value => Types::FREE_PASS_PARTICIPANT->value,
                                Types::FREE_PASS_STAFF->value => Types::FREE_PASS_STAFF->value,
                                Types::FREE_PASS_COMPANION->value => Types::FREE_PASS_COMPANION->value,
                                Types::VIP->value => Types::VIP->value
                            ])->columnSpan(2)->live(),
                            Select::make('gender')->label('Sexo')->options(collect($genders)->pluck('name', 'id'))->columnSpan(3),
                            Select::make('document_type')->label('Tipo de documento')->options(collect($document_types)->pluck('name', 'id'))->columnSpan(3),
                            TextInput::make('document_number')->label('Número de documento')->required()->columnSpan(3),
                            TextInput::make('email')->label('Email')->required()->unique('users', 'email', ignoreRecord: true)->columnSpan(3),
                            TextInput::make('phone')->label('Celular')->columnSpan(3)->required(),
                            DatePicker::make('date_of_issue')->label('Fecha de emisión')->columnSpan(3),
                            TextInput::make('place_of_issue')->label('Lugar de emisión')->required()->columnSpan(3),
                            DatePicker::make('date_of_birth')->label('Fecha de nacimiento')->columnSpan(3),
                            TextInput::make('nationality')->label('Nacionalidad')->columnSpan(3),
                            TextInput::make('city_of_permanent_residency')->label('Ciudad de residencia')->columnSpan(6),
                            TextInput::make('amount')->label('Monto a pagar')->numeric()->columnSpan(3)->required(),
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
                    ])->hidden(fn(Forms\Get $get) => in_array($get('type'), [
                        Types::COMPANION->value,
                        Types::STAFF->value,
                        Types::FREE_PASS_STAFF->value,
                        Types::FREE_PASS_COMPANION->value
                    ])),
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
                                    Select::make('type')->label('Tipo')->options([
                                        Types::COMPANION->value => Types::COMPANION->value,
                                        Types::STAFF->value => Types::STAFF->value,
                                        Types::FREE_PASS_COMPANION->value => Types::FREE_PASS_COMPANION->value,
                                        Types::FREE_PASS_STAFF->value => Types::FREE_PASS_STAFF->value,
                                    ])->required()->columnSpan(4)->live(),
                                    TextInput::make('name')->label('Nombre')->required()->columnSpan(4),
                                    TextInput::make('last_name')->label('Apellidos')->required()->columnSpan(4),
                                    TextInput::make('phone')->label('Nombre')->required()->columnSpan(4),
                                    TextInput::make('email')->label('Email')->required()->columnSpan(4),
                                    TextInput::make('amount')->label('Monto a pagar')->numeric()->required()->columnSpan(4)
                                ])
                            ])->itemLabel(fn (array $state): ?string => $state['type'] ?? null)->hidden(fn(Forms\Get $get) => in_array($get('type'), [
                                Types::COMPANION->value,
                                Types::STAFF->value,
                                Types::FREE_PASS_STAFF->value,
                                Types::FREE_PASS_COMPANION->value
                            ]))
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
                            Toggle::make('allergies')->inline(false)->label('Alergias')->columnSpan(2),
                            Textarea::make('allergy_details')->label('Detalle')->columnSpanFull(),
                            Forms\Components\CheckboxList::make('vaccines')->label('Vacunas')->columnSpanFull()
                                ->options([
                                    'COVID-19' => 'COVID-19',
                                    'Hepatitis A' => 'Hepatitis A',
                                    'Hepatitis B' => 'Hepatitis B',
                                    'Yellow fever' => 'Yellow fever',
                                ]),
                            Textarea::make('medical_others')->label('Otros')->columnSpanFull(),
                            Toggle::make('medical_treatment')->inline(false)->label('Tratamiento médico')->columnSpan(3),
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
                            Forms\Components\FileUpload::make('badge_photo')->label('Foto')->disk('badges')->downloadable()->openable()->columnSpanFull(),
                            Forms\Components\FileUpload::make('identity_document')->disk('ids')->label('Documento de identidad')->downloadable()->openable()->columnSpanFull(),
                        ])
                    ]),
                    Tab::make('Información de vuelo')->schema([
                        Section::make('Información de llegada')->schema([
                            Grid::make([
                                'default' => 1,
                                'sm' => 3,
                                'xl' => 12,
                                '2xl' => 12
                            ])->schema([
                                TextInput::make('arrived_air_line')->label('Línea aérea')->columnSpan(4),
                                TextInput::make('arrived_origin')->label('Origen')->columnSpan(4),
                                TextInput::make('arrived_flight_number')->label('Número de vuelo')->columnSpan(4),
                                DatePicker::make('arrived_date')->label('Fecha')->columnSpan(6),
                                TimePicker::make('arrived_time')->label('Hora')->columnSpan(6),
                            ])
                        ]),
                        Section::make('Información de salida')->schema([
                            Grid::make([
                                'default' => 1,
                                'sm' => 3,
                                'xl' => 12,
                                '2xl' => 12
                            ])->schema([
                                TextInput::make('exit_air_line')->label('Línea aérea')->columnSpan(4),
                                TextInput::make('exit_destination')->label('Destino')->columnSpan(4),
                                TextInput::make('exit_flight_number')->label('Número de vuelo')->columnSpan(4),
                                DatePicker::make('exit_date')->label('Fecha')->columnSpan(6),
                                TimePicker::make('exit_time')->label('Hora')->columnSpan(6),
                            ])
                        ]),
                        TextInput::make('flight_contact_number')->label('Número de contacto')->columnSpanFull(),
                        Toggle::make('flight_free_transportation')->label('¿Transporte gratuito desde el aeropuerto al hotel?')->columnSpanFull(),
                        Textarea::make('flight_details')->label('Detalle')->columnSpanFull(),
                    ]),
                    Tab::make('Información de hotel')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('hotel_name')->label('Nombre')->columnSpan(8),
                            TextInput::make('hotel_room')->label('Habitación')->columnSpan(4),

                            Section::make('Información de Check-in')->schema([
                                Grid::make([
                                    'default' => 1,
                                    'sm' => 3,
                                    'xl' => 12,
                                    '2xl' => 12
                                ])->schema([
                                    DatePicker::make('hotel_check_in_date')->label('Fecha')->columnSpan(6),
                                    TimePicker::make('hotel_check_in_hour')->label('Hora')->columnSpan(6),
                                ])
                            ])->columnSpan(6),
                            Section::make('Información de Check-out')->schema([
                                Grid::make([
                                    'default' => 1,
                                    'sm' => 3,
                                    'xl' => 12,
                                    '2xl' => 12
                                ])->schema([
                                    DatePicker::make('hotel_check_out_date')->label('Fecha')->columnSpan(6),
                                    TimePicker::make('hotel_check_out_hour')->label('Hora')->columnSpan(6),
                                ])
                            ])->columnSpan(6)
                        ]),
                        Textarea::make('hotel_details')->label('Detalle')->columnSpanFull(),
                    ]),
                    Tab::make('QR')->schema([
                        Forms\Components\FileUpload::make('qr')->label('Código QR')->disk('qrs')->downloadable()->openable()->columnSpanFull(),
                    ]),
                    Tab::make('Información de Cancillería')->schema([
                        FilamentJsonColumn::make('chancellery_sent_response')->viewerOnly()->label('Respuesta de Cancillería luego de enviar los datos')->columnSpanFull(),
                        FilamentJsonColumn::make('chancellery_receive_response')->viewerOnly()->label('Datos enviados hacia el Webhook por parte de Cancillería')->columnSpanFull(),
                    ]),
                    Tab::make('Invitado por')->schema([
                        Section::make('')->schema([
                            Grid::make([
                                'default' => 1,
                                'sm' => 3,
                                'xl' => 12,
                                '2xl' => 12
                            ])->schema([
                                TextInput::make('name')->label('Nombre')->readOnly()->columnSpan(6),
                                TextInput::make('last_name')->label('Apellidos')->readOnly()->columnSpan(6),
                                TextInput::make('phone')->label('Celular')->readOnly()->columnSpan(6),
                                TextInput::make('email')->label('Email')->readOnly()->columnSpan(6)
                            ])
                        ])->relationship('parent')->hidden(fn(Forms\Get $get) => in_array($get('type'), [
                            Types::PARTICIPANT->value,
                            Types::FREE_PASS_PARTICIPANT->value,
                            Types::SECURITY->value,
                            Types::EXHIBITOR->value,
                            Types::LIAISON->value,
                            Types::VIP->value
                        ]))
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) =>
                $query->whereIn('status', [
                    Status::PENDING_ACCREDITATION->value,
                    Status::OBSERVED_ACCREDITATION->value,
                    Status::CANCEL_ACCREDITATION->value,
                    Status::ACCREDITED->value,
                ]))->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')->label('Nombres')->searchable()->sortable(),
                TextColumn::make('last_name')->label('Apellidos')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable()->sortable(),
                TextColumn::make('type')->label('Tipo')->sortable(),
                TextColumn::make('status')->label('Estado')->badge()->color(fn (string $state): string => match ($state) {
                    Status::PENDING_ACCREDITATION->value => 'success',
                    Status::OBSERVED_ACCREDITATION->value => 'success',
                    Status::CANCEL_ACCREDITATION->value => 'danger',
                    Status::ACCREDITED->value => 'success',
                    Status::ERROR_IN_CHANCELLERY->value => 'danger',
                    default => 'primary'
                }),
                TextColumn::make('created_at')->label('Fecha de registro')->date('d/m/Y H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
                SelectFilter::make('status')->label('Estado')
                    ->multiple()
                    ->options([
                        Status::PENDING_ACCREDITATION->value => Status::PENDING_ACCREDITATION->value,
                        Status::OBSERVED_ACCREDITATION->value => Status::OBSERVED_ACCREDITATION->value,
                        Status::CANCEL_ACCREDITATION->value => Status::CANCEL_ACCREDITATION->value,
                        Status::ACCREDITED->value => Status::ACCREDITED->value
                    ]),
                SelectFilter::make('economy')->label('Economía')
                    ->multiple()
                    ->options(Economy::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make()
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
            'index' => Pages\ListAccreditedUsers::route('/'),
            'create' => Pages\CreateAccreditedUser::route('/create'),
            'edit' => Pages\EditAccreditedUser::route('/{record}/edit'),
        ];
    }
}
