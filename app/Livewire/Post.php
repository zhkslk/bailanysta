<?php

namespace App\Livewire;

use App\Models\Post as PostModel;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Post extends Component
{
    public PostModel $post;

    public function toggleLike(): void
    {
        $this->post->likes()->toggle(auth()->user());
    }

    public function render(): View
    {
        return view('livewire.post');
    }
}
