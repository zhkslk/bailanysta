<section class="w-full">
    <x-heading :heading="__('Feed')" />

    <div class="flex flex-col gap-4">
        <flux:modal.trigger name="createPost" wire:click="$dispatch('openCreatePostModal')">
            <flux:button icon="plus">
                Create post
            </flux:button>
        </flux:modal.trigger>

        <div class="flex flex-col gap-3">
            @foreach ($posts as $post)
                @livewire('post', ['post' => $post], key($post->id))
            @endforeach

            @if ($posts->hasMorePages())
                <flux:button wire:click="loadMore" icon="chevron-down">
                    Load more
                </flux:button>
            @endif
        </div>
    </div>

    @livewire('create-post')
</section>
