<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserProfile extends Component
{
    public ?User $user;

    public function mount(string $username)
    {
        $this->user = User::with('posts.comments.user', 'posts.likes')->where('username', $username)->first();
        if (! $this->user) {
            abort(404);
        }
    }

    public function render(): View
    {
        return view('livewire.profile')->title($this->user->username);
    }
}
