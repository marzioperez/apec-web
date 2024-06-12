<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OrdersChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Page;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets;

class AnalyticsDashboard extends Page {

    protected static ?string $navigationIcon = 'heroicon-s-home';
    protected static string $view = 'filament.pages.analytics-dashboard';
    protected static ?string $title = 'Escritorio';

    protected function getHeaderWidgets(): array {
        return [
            StatsOverview::class,
            OrdersChart::class,
            Widgets\PageViewsWidget::class,
            Widgets\VisitorsWidget::class,
            Widgets\ActiveUsersOneDayWidget::class,
            Widgets\ActiveUsersSevenDayWidget::class,
            Widgets\ActiveUsersTwentyEightDayWidget::class,
            Widgets\SessionsWidget::class,
            Widgets\SessionsDurationWidget::class,
            Widgets\SessionsByCountryWidget::class,
            Widgets\SessionsByDeviceWidget::class,
            Widgets\MostVisitedPagesWidget::class,
            Widgets\TopReferrersListWidget::class,
        ];
    }
}
