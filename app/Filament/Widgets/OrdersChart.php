<?php

namespace App\Filament\Widgets;

use App\Concerns\Enums\Status;
use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrdersChart extends ChartWidget {
    protected static ?string $heading = "Ingresos obtenidos durante el año";
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '200px';
    protected static ?int $sort = 1;

    protected function getData(): array {
        $data = Trend::query(Order::where('status', Status::PAID->value))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )->perMonth()->sum('amount');
        return [
            'datasets' => [
                [
                    'label' => 'Recaudado ' . date('Y'),
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => ucfirst(Carbon::parse($value->date)->locale('es_ES')->monthName)),
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
