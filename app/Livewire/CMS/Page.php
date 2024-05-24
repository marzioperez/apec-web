<?php

namespace App\Livewire\CMS;

use Livewire\Component;

class Page extends Component {

    public $blocks = [];
    public \App\Models\Page $page;

    public function mount($slug = '/') {
        $model = \App\Models\Page::where('slug', $slug)->get()->first();
        if ($model) {
            $this->page = $model;
            $this->blocks = $model['content'];
        } else {
            $this->redirect(config('app.url'));
        }
    }

    public function render() {
        return view('livewire.c-m-s.page');
    }
}
