<?php

namespace App\Filament\Resources\Event\UserResource\Pages;

use App\Concerns\Enums\Status;
use App\Filament\Resources\Event\UserResource;
use App\Imports\UpdatePasswordUsers;
use App\Imports\Users;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;

class ListUsers extends ListRecords {

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import')->label('Importar')->color('success')
                ->form([
                    FileUpload::make('file')->label('Archivo')
                        ->hint(new HtmlString('<a href="'. asset('formats/formato-usuarios.xlsx') .'" target="_blank">Descargar formato</a>'))
                        ->hintColor('primary')
                ])
                ->action(function(array $data): void {
                    Excel::import(new Users(), storage_path("app/public/{$data['file']}"));
                    if(Storage::exists("public/{$data['file']}")) {
                        sleep(2);
                        Storage::delete("public/{$data['file']}");
                    }
                    $this->redirect('/admin/event/users');
                }),
            Actions\Action::make('import-update-password')->label('Actualizar credenciales')->color('gray')
                ->form([
                    FileUpload::make('file')->label('Archivo')
                ])
                ->action(function(array $data): void {
                    Excel::import(new UpdatePasswordUsers(), storage_path("app/public/{$data['file']}"));
                    if(Storage::exists("public/{$data['file']}")) {
                        sleep(2);
                        Storage::delete("public/{$data['file']}");
                    }
                    $this->redirect('/admin/event/users');
                })
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
