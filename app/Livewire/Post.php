<?php

namespace App\Livewire;

use App\Models\Post as PostModel;
use App\Notifications\NewComment;
use App\Notifications\PostLiked;
use App\Notifications\PostUnliked;
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
        if ($this->post->likes()->where('user_id', auth()->id())->exists()) {
            $this->post->likes()->detach(auth()->id());
            $this->post->user->notify(new PostUnliked($this->post, auth()->user()));
        } else {
            $this->post->likes()->attach(auth()->id());
            $this->post->user->notify(new PostLiked($this->post, auth()->user()));
        }
    }

    public function comment(): void
    {
        $this->validate();

        $comment = $this->post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $this->commentBody,
        ]);

        $this->post->user->notify(new NewComment($this->post, auth()->user(), $comment));

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
