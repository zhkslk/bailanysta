<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('My posts')">
        <div class="flex flex-col gap-4">
            <flux:modal.trigger name="createPost" wire:click="$dispatch('openCreatePostModal')">
                <flux:button icon="plus">
                    Create post
                </flux:button>
            </flux:modal.trigger>

            <div class="flex flex-col gap-3">
                @foreach ($posts as $post)
                    <x-card>
                        <a href="{{ route('profile', $post->user->username) }}" class="flex items-center gap-3" wire:navigate>
                            <flux:avatar :initials="ucfirst($post->user->username[0])" />
                            <flux:heading size="lg">{{ $post->user->username }}</flux:heading>
                        </a>
                        <p>{{ $post->body }}</p>
                        <flux:subheading class="text-right" size="sm">
                            {{ $post->created_at->diffForHumans() }}
                        </flux:subheading>
                    </x-card>
                @endforeach
            </div>
        </div>

        @livewire('create-post')
    </x-settings.layout>
</section>
