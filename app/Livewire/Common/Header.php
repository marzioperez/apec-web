<?php

namespace App\Livewire\Common;

use App\Models\Menu;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component {

    public $is_logged_in = false;
    public $user_name;
    public $menu_items = [];

    public function mount() {
        $menu = Menu::with('items')->where('position', 'header')->get()->last();
        if ($menu) {
            $this->menu_items = $menu->items;
        }
        if (auth()->check()) {
            $this->is_logged_in = true;
            $this->user_name = auth()->user()->full_name;
        }
    }

    #[On('user-logged')]
    public function user_logged(): void {
        $this->is_logged_in = auth()->check();
        $this->user_name = auth()->check() ? auth()->user()->full_name : null;
    }

    public function logout() {
        auth()->logout();
        $this->is_logged_in = false;
        $this->user_name = null;
        $this->redirect(config('app.url'));
    }

    public function render() {
        return view('livewire.common.header');
    }
}
