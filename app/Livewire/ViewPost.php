<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ViewPost extends Component
{
    public ?Post $post;

    public function mount(int $postId)
    {
        dd($postId);
    }

    public function render(): View
    {
        return view('livewire.profile')->title($this->user->username);
    }
}
