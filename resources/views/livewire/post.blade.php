<x-card>
    <div x-data="{ showComments: {{ $post->comments_count ? 'true' : 'false' }} }" class="space-y-6">
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

        <div>
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
                        <flux:icon.chat-bubble-oval-left
                            class="cursor-pointer"
                            x-on:click="console.log(showComments); showComments = ! showComments; console.log(showComments)"
                        />
                        {{ $post->comments()->count() }}
                    </div>
                </div>

                <flux:subheading class="text-right" size="sm">
                    {{ $post->created_at->diffForHumans() }}
                </flux:subheading>
            </div>

            <div x-show="showComments" style="display: none" class="mt-6 pl-5">
                <div class="space-y-4">
                    @foreach ($post->comments as $comment)
                        <div class="flex items-start gap-2">
                            <flux:avatar circle size="sm" :initials="ucfirst($comment->user->username[0])" />

                            <div class="space-y-3">
                                <div>{!! nl2br($comment->body) !!}</div>
                                <flux:subheading size="sm">{{ $comment->created_at->diffForHumans() }}</flux:subheading>
                            </div>
                        </div>
                    @endforeach

                    <div class="flex items-start gap-2">
                        <flux:avatar circle size="sm" :initials="ucfirst($post->user->username[0])" />

                        <flux:textarea wire:model="commentBody" rows="1" placeholder="Write a comment..." />

                        <flux:button size="sm" icon="paper-airplane" wire:click="comment" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-card>
