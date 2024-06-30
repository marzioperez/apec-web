<?php

namespace App\Filament\Resources\Event;

use App\Actions\Refund;
use App\Concerns\Enums\PaymentMethods;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Filament\Resources\Event\OrderResource\Pages;
use App\Filament\Resources\Event\OrderResource\RelationManagers;
use App\Mail\CompleteDataFailed;
use App\Mail\PaymentSuccess;
use App\Models\Order;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pedidos';
    protected static ?string $breadcrumb = 'Pedidos';
    protected static ?string $modelLabel = 'pedido';
    protected static ?string $navigationGroup = 'Evento';
    protected static ?int $navigationSort = 18;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Tabs::make()->tabs([
                    Tab::make('Datos para comprobante')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            ToggleButtons::make('voucher_type')->label('Tipo de documento')->live()->columnSpanFull()->options([
                                Types::NATIONAL->value => Types::NATIONAL->value,
                                Types::FOREIGNER->value => Types::FOREIGNER->value,
                            ])->inline(),

                            Select::make('document_type')->label('Tipo de comprobante')->live()->columnSpanFull()->hidden(fn(Forms\Get $get) => in_array($get('voucher_type'), [
                                Types::FOREIGNER->value
                            ]))->options([
                                Types::INVOICE->value => Types::INVOICE->value,
                                Types::TICKET->value => Types::TICKET->value
                            ]),

                            TextInput::make('ruc')->label('RUC')->columnSpan(6)->hidden(
                                function (Forms\Get $get) {
                                    $document_type = $get('document_type');
                                    $voucher_type = $get('voucher_type');
                                    $hidden = false;

                                    if ($voucher_type === Types::FOREIGNER->value) {
                                        $hidden = true;
                                    }

                                    if ($document_type === Types::TICKET->value) {
                                        $hidden = true;
                                    }

                                    return $hidden;
                                }
                            ),
                            TextInput::make('business_name')->label('Razón social')->columnSpan(6)->hidden(
                                function (Forms\Get $get) {
                                    $document_type = $get('document_type');
                                    $voucher_type = $get('voucher_type');
                                    $hidden = false;

                                    if ($voucher_type === Types::FOREIGNER->value) {
                                        $hidden = true;
                                    }

                                    if ($document_type === Types::TICKET->value) {
                                        $hidden = true;
                                    }

                                    return $hidden;
                                }
                            ),

                            TextInput::make('name')->label('Nombre')->columnSpan(4)->hidden(
                                function (Forms\Get $get) {
                                    $document_type = $get('document_type');
                                    $voucher_type = $get('voucher_type');
                                    $hidden = false;

                                    if ($voucher_type === Types::FOREIGNER->value) {
                                        $hidden = true;
                                    }

                                    if ($document_type === Types::INVOICE->value) {
                                        $hidden = true;
                                    }

                                    return $hidden;
                                }
                            ),
                            TextInput::make('last_name')->label('Apellido')->columnSpan(4)->hidden(
                                function (Forms\Get $get) {
                                    $document_type = $get('document_type');
                                    $voucher_type = $get('voucher_type');
                                    $hidden = false;

                                    if ($voucher_type === Types::FOREIGNER->value) {
                                        $hidden = true;
                                    }

                                    if ($document_type === Types::INVOICE->value) {
                                        $hidden = true;
                                    }

                                    return $hidden;
                                }
                            ),
                            TextInput::make('dni')->label('DNI')->columnSpan(4)->hidden(
                                function (Forms\Get $get) {
                                    $document_type = $get('document_type');
                                    $voucher_type = $get('voucher_type');
                                    $hidden = false;

                                    if ($voucher_type === Types::FOREIGNER->value) {
                                        $hidden = true;
                                    }

                                    if ($document_type === Types::INVOICE->value) {
                                        $hidden = true;
                                    }

                                    return $hidden;
                                }
                            ),

                            TextInput::make('client')->label('Client')->columnSpan(6)->hidden(
                                function (Forms\Get $get) {
                                    $voucher_type = $get('voucher_type');
                                    $hidden = false;

                                    if ($voucher_type === Types::NATIONAL->value) {
                                        $hidden = true;
                                    }

                                    return $hidden;
                                }
                            ),

                            TextInput::make('document_id')->label('ID')->columnSpan(6)->hidden(
                                function (Forms\Get $get) {
                                    $voucher_type = $get('voucher_type');
                                    $hidden = false;

                                    if ($voucher_type === Types::NATIONAL->value) {
                                        $hidden = true;
                                    }

                                    return $hidden;
                                }
                            ),

                            TextInput::make('physical_address')->label('Dirección física')->columnSpan(6),
                            TextInput::make('email_address')->label('Email')->columnSpan(6),
                        ])
                    ]),
                    Tab::make('Método de pago')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            ToggleButtons::make('payment_method')->label('Método de pago')->live()->columnSpanFull()->options([
                                PaymentMethods::CREDIT_CARD->value => PaymentMethods::CREDIT_CARD->value,
                                PaymentMethods::BANK_TRANSFER->value => PaymentMethods::BANK_TRANSFER->value
                            ])->live()->inline(),

                            TextInput::make('amount')->label('Monto')->columnSpan(4)->prefix('$')->disabled(),

                            TextInput::make('culqi_id')->label('ID de Culqi')->columnSpan(8)->disabled()->hidden(fn(Forms\Get $get) => $get('payment_method') === PaymentMethods::BANK_TRANSFER->value),

                            Fieldset::make('Datos de transferencia')->schema([
                                Grid::make([
                                    'default' => 1,
                                    'sm' => 3,
                                    'xl' => 12,
                                    '2xl' => 12
                                ])->schema([
                                    TextInput::make('payment_reference_name')->label('Nombres')->columnSpan(3),
                                    TextInput::make('payment_reference_last_name')->label('Apellidos')->columnSpan(3),
                                    TextInput::make('payment_reference_phone')->label('Teléfono')->columnSpan(3),
                                    TextInput::make('payment_reference_email')->label('Email')->columnSpan(3),

                                    FileUpload::make('payment_voucher')->label('Voucher')->disk('vouchers')->openable()->downloadable()->deletable()->columnSpanFull(),
                                ])
                            ])->hidden(fn(Forms\Get $get) => $get('payment_method') === PaymentMethods::CREDIT_CARD->value),
                        ])
                    ]),
                    Tab::make('Observación comprobante')->schema([
                        Forms\Components\Textarea::make('voucher_comment')->label('Comentario')->columnSpanFull()
                    ]),
                ])->columnSpanFull()->activeTab(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('user'))
            ->columns([
                TextColumn::make('user.name')->searchable()->label('Nombre'),
                TextColumn::make('user.last_name')->searchable()->label('Apellidos'),
                TextColumn::make('payment_method')->searchable()->label('Método de pago'),
                TextColumn::make('status')->searchable()->label('Estado')->badge()->color(fn (string $state): string => match ($state) {
                    Status::PAID->value => 'success',
                    Status::UNPAID->value => 'warning',
                    default => 'primary'
                }),
                TextColumn::make('voucher_status')->searchable()->label('Estado del comprobante')->badge()->color(fn (string $state): string => match ($state) {
                    Status::EMITTED->value => 'success',
                    Status::OBSERVED->value => 'warning',
                    default => 'primary'
                }),
                TextColumn::make('created_at')->date('d/m/Y H:i')->label('Fecha de registro'),
            ])
            ->filters([
                SelectFilter::make('status')->label('Estado')
                    ->multiple()
                    ->options([
                        Status::PAID->value => Status::PAID->value,
                        Status::UNPAID->value => Status::UNPAID->value,
                        Status::PAYMENT_REVIEW->value => Status::PAYMENT_REVIEW->value,
                    ]),
                SelectFilter::make('voucher_status')->label('Comprobante')
                    ->multiple()
                    ->options([
                        Status::PENDING->value => Status::PENDING->value,
                        Status::EMITTED->value => Status::EMITTED->value,
                        Status::OBSERVED->value => Status::OBSERVED->value,
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->label('Ver'),
                    Action::make('confirm')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->label('Confirmar')
                        ->requiresConfirmation()
                        ->modalHeading('¿Confirmar pago?')
                        ->modalDescription('Una vez que se confirme esta acción, el usuario pasará al estado Pendiente de aprobación de datos.')
                        ->modalSubmitActionLabel('Confirmar')
                        ->action(function (Order $order):void {
                            $order->update(['status' => Status::PAID->value]);
                            $order->user->update(['status' => Status::PENDING_APPROVAL_DATA->value]);
                            Mail::to($order->user->user['email'])->send(new PaymentSuccess($order->user));
                        })->visible(fn(Order $order): bool => $order['payment_method'] === PaymentMethods::BANK_TRANSFER->value),
                    Action::make('emitted')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->label('Comprobante emitido')
                        ->requiresConfirmation()
                        ->modalHeading('¿Confirmar pago?')
                        ->modalDescription('Confirme que la empresa ha emitido el comprobante al participante.')
                        ->modalSubmitActionLabel('Confirmar')
                        ->action(function (Order $order):void {
                            $order->update(['voucher_status' => Status::EMITTED->value]);
                        })->visible(fn(Order $order): bool => $order['voucher_status'] === Status::PENDING->value || $order['voucher_status'] === Status::OBSERVED->value),
                    Action::make('observe')
                        ->icon('heroicon-o-eye')
                        ->color('warning')
                        ->label('Comprobante observado')
                        ->modalHeading('Comentario de comprobante')
                        ->modalDescription('Ingrese el comentario del comprobante')
                        ->form([
                            Forms\Components\Textarea::make('voucher_comment')->label('Observación')->required()->columnSpanFull(),
                        ])
                        ->modalSubmitActionLabel('Aceptar')
                        ->action(function (array $data, Order $order):void {
                            $order->update([
                                'voucher_status' => Status::OBSERVED->value,
                                'voucher_comment' => $data['voucher_comment']
                            ]);
                        })->visible(fn(Order $order): bool => $order['voucher_status'] === Status::PENDING->value),
                    Action::make('revert-transfer')
                        ->icon('heroicon-o-arrow-path')
                        ->color('danger')
                        ->label('Revertir pago')
                        ->requiresConfirmation()
                        ->modalHeading('¿Revertir pago?')
                        ->modalDescription('Una vez que se confirme esta acción, el usuario pasará al estado Pendiente de pago y se eliminará la información de su comprobante.')
                        ->modalSubmitActionLabel('Confirmar')
                        ->action(function (Order $order):void {
                            $order->update([
                                'status' => Status::UNPAID->value,
                                'payment_reference_name' => null,
                                'payment_reference_last_name' => null,
                                'payment_reference_phone' => null,
                                'payment_reference_email' => null,
                                'payment_voucher' => null
                            ]);
                            $order->user->update(['status' => Status::UNPAID->value]);
                        })->visible(fn(Order $order): bool => $order['payment_method'] === PaymentMethods::BANK_TRANSFER->value && $order['status'] === Status::PAID->value),
                    Action::make('revert-card')
                        ->icon('heroicon-o-arrow-path')
                        ->color('danger')
                        ->label('Revertir pago')
                        ->requiresConfirmation()
                        ->modalHeading('¿Revertir pago?')
                        ->modalDescription('Una vez que se confirme esta acción, el usuario pasará al estado Pendiente de pago y se realizará la devolución de su dinero en Culqi.')
                        ->modalSubmitActionLabel('Confirmar')
                        ->action(function (Order $order):void {
                            $refund = Refund::run($order);
                            if ($refund->status === "completa") {
                                $order->update([
                                    'status' => Status::UNPAID->value,
                                    'culqi_id' => null
                                ]);
                                $order->user->update(['status' => Status::UNPAID->value]);
                            }
                        })->visible(fn(Order $order): bool => $order['payment_method'] === PaymentMethods::CREDIT_CARD->value && $order['status'] === Status::PAID->value),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
