<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;

class QrReader extends Page {

    use HasPageShield;
    public $user;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static string $view = 'filament.pages.qr-reader';

    protected static ?string $navigationGroup = 'Evento';
    protected static ?string $navigationLabel = 'Lector de QR';
    protected static ?string $breadcrumb = 'Escanear QR';
    protected static ?string $title = 'Escanear QR';
    protected static ?int $navigationSort = 20;

    protected function getShieldRedirectPath(): string {
        return '/'; // redirect to the root index...
    }
}
