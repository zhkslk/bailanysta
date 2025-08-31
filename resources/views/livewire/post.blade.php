<x-card>
    <div class="flex items-center justify-between">
        <a href="{{ route('profile', $post->user->username) }}" class="flex items-center gap-3" wire:navigate>
            <flux:avatar :initials="ucfirst($post->user->username[0])" />
            <flux:heading size="lg">{{ $post->user->username }}</flux:heading>
        </a>

        @if (auth()->id() === $post->user_id)
            <flux:dropdown>
                <flux:button variant="ghost" size="sm" icon="ellipsis-vertical" />
                <flux:menu>
                    <flux:menu.item variant="danger" icon="trash" wire:click="delete">Delete</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        @endif
    </div>

    <p>{!! nl2br($post->body) !!}</p>

    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1">
                <flux:icon.heart
                    wire:click="toggleLike"
                    class="cursor-pointer {{ $post->is_liked ? 'text-red-700' : '' }}"
                    :variant="$post->is_liked ? 'solid' : 'outline'"
                />
                <span wire:loading.remove wire:target="toggleLike">{{ $post->likes()->count() }}</span>
                <flux:icon.loading class="size-3" wire:loading wire:target="toggleLike" />
            </div>

            <div class="flex items-center gap-1">
                <flux:icon.chat-bubble-oval-left />
                0
            </div>
        </div>

        <flux:subheading class="text-right" size="sm">
            {{ $post->created_at->diffForHumans() }}
        </flux:subheading>
    </div>
</x-card>
