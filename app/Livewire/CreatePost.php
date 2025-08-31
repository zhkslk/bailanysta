<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;

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

    public function generate(): void
    {
        $this->validate();

        $response = Prism::text()
            ->using(Provider::OpenAI, 'gpt-4.1')
            ->withSystemPrompt('You are a helpful assistant for generating content for social media posts. You should generate content for a post with 2 or 3 sentences. The post should be interesting and engaging.')
            ->withPrompt($this->body)
            ->asText();

        $this->body = $response->text;
    }

    public function render(): View
    {
        return view('livewire.create-post');
    }
}
