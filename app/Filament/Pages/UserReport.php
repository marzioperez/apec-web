<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class UserReport extends Page {

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.user-report';
    protected static ?string $title = 'Reporte de usuarios';
    protected static ?int $navigationSort = 30;
    protected static ?string $navigationGroup = 'Reportes';

}
