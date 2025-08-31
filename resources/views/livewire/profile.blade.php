<section class="w-full">
    <x-heading :heading="$user->username" />

    <div class="flex flex-col gap-3">
        @foreach ($user->posts as $post)
            @livewire('post', ['post' => $post], key($post->id))
        @endforeach
    </div>
</section>
