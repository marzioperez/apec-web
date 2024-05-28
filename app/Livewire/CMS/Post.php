<?php

namespace App\Livewire\CMS;

use Livewire\Attributes\Url;
use Livewire\Component;

class Post extends Component {

    public \App\Models\Post $post;

    public function mount($slug) {
        $post = \App\Models\Post::where('slug', $slug)->first();
        if ($post) {
            $this->post = $post;
        } else {
            $this->redirect(config('app.url'));
        }
    }

    public function render() {
        return view('livewire.cms.post');
    }
}
