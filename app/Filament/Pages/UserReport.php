<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;

class UserReport extends Page {

    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.user-report';
    protected static ?string $title = 'Reporte de usuarios';
    protected static ?int $navigationSort = 30;
    protected static ?string $navigationGroup = 'Reportes';

    protected function getShieldRedirectPath(): string {
        return '/'; // redirect to the root index...
    }

}
