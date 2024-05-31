<?php

namespace App\Livewire\Common;

use App\Models\Menu;
use Livewire\Component;

class MenuMobile extends Component {

    public $menu_items = [];
    public function mount() {
        $menu = Menu::with('items')->where('position', 'header')->get()->last();
        if ($menu) {
            $this->menu_items = $menu->items;
        }
    }

    public function render() {
        return view('livewire.common.menu-mobile');
    }
}
