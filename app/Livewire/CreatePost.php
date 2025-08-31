<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreatePost extends Component
{
    public string $body;

    public $rules = [
        'body' => 'required',
    ];

    public function open(): void
    {
        $this->reset();
    }

    public function create(): void
    {
        $this->validate();

        auth()->user()->posts()->create([
            'body' => $this->body,
        ]);

        Flux::modals()->close();
        $this->dispatch('postsUpdated');
    }

    public function render(): View
    {
        return view('livewire.create-post');
    }
}
