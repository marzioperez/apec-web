<?php

namespace App\Filament\Resources\Event\CompletedUserResource\Widgets;

use App\Settings\GeneralSetting;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ChancelleryApiStatus extends BaseWidget {

    protected function getStats(): array {
        $settings = new GeneralSetting();
        $api_status = $settings->chancellery_api_status;
        $description = 'Actualmente el API se encuentra disponible para recibir datos de participantes.';
        if (!$api_status) {
            $description = 'Actualmente el API NO se encuentra disponible para recibir datos de participantes.';
        }

        return [
            Stat::make('Estado del API de Cancillería', ($api_status ? 'ON' : 'OFF'))
                ->icon('heroicon-o-' . ($api_status ? 'sun' : 'moon'))
                ->description($description)
        ];
    }
}
