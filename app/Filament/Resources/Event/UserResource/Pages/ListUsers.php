<?php

namespace App\Filament\Resources\Event\UserResource\Pages;

use App\Concerns\Enums\Status;
use App\Filament\Resources\Event\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords {

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array {
        return [
            'Todos' => ListRecords\Tab::make(),
            Status::PENDING_APPROVAL->value => ListRecords\Tab::make()
                ->modifyQueryUsing(fn(Builder $query) =>
                    $query->where('status', Status::PENDING_APPROVAL->value)
                ),
            Status::CONFIRMED->value => ListRecords\Tab::make()
                ->modifyQueryUsing(fn(Builder $query) =>
                    $query->where('status', Status::CONFIRMED->value)
                ),
            Status::DECLINED->value => ListRecords\Tab::make()
                ->modifyQueryUsing(fn(Builder $query) =>
                    $query->where('status', Status::DECLINED->value)
                ),
        ];
    }
}
