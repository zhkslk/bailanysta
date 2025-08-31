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

    #[On('postsUpdated')]
    public function refresh(): void {}

    public function getPosts()
    {
        return Post::with('user')
            ->withCount('likes')
            ->latest()
            ->paginate(15);
    }

    public function render(): View
    {
        return view('livewire.feed', [
            'postsExist' => Post::count() > 0,
            'posts' => $this->getPosts(),
            // todo all posts, or following
        ])->title(__('Feed'));
    }
}
