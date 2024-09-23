<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Ajustes';
    protected static ?string $title = 'Ajustes generales';
    protected static ?int $navigationSort = 41;

    protected static string $settings = GeneralSetting::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        Toggle::make('chancellery_api_status')->label('Estado del API de Cancillería')->columnSpanFull(),
                    ])
                ]),
                Section::make()->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        FileUpload::make('abac_file')->label('Archivo ABAC')->required()->preserveFilenames()->disk('public_files')->columnSpanFull(),
                    ])
                ]),
                Section::make()->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        FileUpload::make('check_out_file')->label('Archivo Check out')->required()->preserveFilenames()->disk('public_files')->columnSpanFull(),
                    ])
                ])
            ]);
    }
}
