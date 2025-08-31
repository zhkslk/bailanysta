<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Posts extends Component
{
    #[On('postCreated')]
    public function refresh(): void {}

    public function render(): View
    {
        return view('livewire.settings.posts', [
            'posts' => auth()->user()->posts()->withCount('likes')->latest()->get(),
        ])->title(__('My posts'));
    }
}
