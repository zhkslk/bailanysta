<?php

namespace App\Livewire;

use App\Models\Post as PostModel;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Post extends Component
{
    public PostModel $post;
    public string $commentBody = '';

    public $rules = [
        'commentBody' => 'required',
    ];

    public function toggleLike(): void
    {
        $this->post->likes()->toggle(auth()->user());
    }

    public function comment(): void
    {
        $this->validate();

        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $this->commentBody,
        ]);

        $this->commentBody = '';
    }

    public function delete(): void
    {
        $this->post->delete();

        $this->dispatch('postsUpdated');
    }

    public function render(): View
    {
        return view('livewire.post');
    }
}
