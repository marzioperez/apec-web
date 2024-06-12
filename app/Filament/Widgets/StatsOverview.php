<?php

namespace App\Filament\Widgets;

use App\Concerns\Enums\Status;
use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array {
        $total_users = User::all()->count();
        $pending_approve_users = User::where('status', Status::PENDING_APPROVAL_DATA)->get()->count();
        $total_amount = Order::where('status', Status::PAID)->get()->sum('amount');
        return [
            Stat::make('Usuarios registrados', $total_users)->icon('heroicon-s-users')->description('Cantidad de usuarios registrados en total'),
            Stat::make('Usuarios pendientes de aprobación', $pending_approve_users)->icon('heroicon-s-users')->description('Usuarios pendientes de aprobación'),
            Stat::make('Total recaudado', "$" . number_format($total_amount, '2', '.'))->icon('heroicon-s-users')->description('Total de dinero recaudado'),
        ];
    }
}
