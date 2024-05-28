<?php

namespace App\Livewire\CMS;

use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component {

    use WithPagination;

    public function render() {
        $posts = \App\Models\Post::paginate(6);
        return view('livewire.cms.blog', ['posts' => $posts]);
    }
}
