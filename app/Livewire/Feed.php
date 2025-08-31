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

    public $perPage = 15;
    public $page = 1;

    #[On('postsUpdated')]
    public function refresh(): void {}

    public function loadMore(): void
    {
        $this->page++;
    }

    public function getPosts()
    {
        return Post::with('user')
            ->with('comments.user')
            ->withCount(['likes', 'comments'])
            ->latest()
            ->paginate($this->page * $this->perPage);
    }

    public function render(): View
    {
        return view('livewire.feed', [
            'posts' => $this->getPosts(),
        ])->title(__('Feed'));
    }
}
