<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Feed extends Component
{
    use WithPagination;

    #[On('postCreated')]
    public function refresh(): void {}

    public function render(): View
    {
        return view('livewire.feed', [
            'posts' => Post::with('user')->latest()->paginate(15),
        ])->title(__('Feed'));
    }
}
