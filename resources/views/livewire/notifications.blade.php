<section class="w-full">
    <x-heading :heading="__('Notifications')" />

    <div class="flex flex-col gap-3">
        @if ($unreadCount)
            <flux:button wire:click="markAllAsRead" icon="check">
                Mark all as read
            </flux:button>
        @endif

        @foreach ($notifications as $notification)
            <x-card>
                <div class="flex flex-col gap-2">
                    <div>
                        {!! $notification->data['message'] ?? '' !!}
                    </div>

                    <div class="flex items-center justify-between">
                        <flux:subheading size="sm">
                            {{ $notification->created_at->diffForHumans() }}
                        </flux:subheading>

                        @if (! $notification->read_at)
                            <flux:button size="sm" wire:click="markAsRead('{{ $notification->id }}')" icon="check">
                                Mark as read
                            </flux:button>
                        @endif
                    </div>
                </div>
            </x-card>
        @endforeach

        @if ($notifications->hasMorePages())
            <flux:button wire:click="loadMore" icon="chevron-down">
                Load more
            </flux:button>
        @endif
    </div>
</section>
