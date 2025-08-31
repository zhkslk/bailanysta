<flux:modal name="createPost" class="w-180 md:w-240">
    <flux:icon.loading wire:loading wire:target="open" />

    <div class="space-y-6" wire:loading.remove wire:target="open">
        <div>
            <flux:heading size="lg">Create post</flux:heading>
        </div>

        <flux:textarea label="Post" wire:model="body" :placeholder="__('Ne bolyp ketti?')" />

        <div class="flex">
            <flux:spacer />
            <flux:button variant="primary" wire:click="create">Create</flux:button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.on("openCreatePostModal", () => {
                @this.open();
            });
        });
    </script>
</flux:modal>
