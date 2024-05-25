<?php

namespace App\Filament\Resources\Event\SponsorResource\Pages;

use App\Filament\Resources\Event\SponsorResource;
use App\Models\CategorySponsor;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSponsors extends ListRecords {

    protected static string $resource = SponsorResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array {
        $tabs = ['all' => Tab::make('Todos')];

        $categories = CategorySponsor::all();

        foreach ($categories as $category) {
            $name = $category->name;
            $slug = str($name)->slug()->toString();

            $tabs[$slug] = Tab::make($name)
                ->modifyQueryUsing(function ($query) use ($category) {
                    return $query->where('category_sponsor_id', $category->id);
                });
        }

        return $tabs;
    }
}
