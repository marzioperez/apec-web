<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class QrReader extends Page {

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static string $view = 'filament.pages.qr-reader';

    protected static ?string $navigationGroup = 'Evento';
    protected static ?string $navigationLabel = 'Lector de QR';
    protected static ?string $breadcrumb = 'Escanear QR';
    protected static ?string $title = 'Escanear QR';
    protected static ?int $navigationSort = 20;
}
