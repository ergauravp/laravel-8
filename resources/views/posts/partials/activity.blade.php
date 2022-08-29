<div class="container">
    <div class="row">
        <x-card>
            <x-slot name="title">Most commented</x-slot>
            <x-slot name="subtitle">What people are talking about currently.</x-slot>
            <x-slot name="items">
                @foreach ($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            </x-slot>
        </x-card>                
    </div> 
    <div class="row mt-4">
        <x-card>
            <x-slot name="title">Most Active</x-slot>
            <x-slot name="subtitle">Writers with most posts written.</x-slot>
            @slot('items',collect($mostActive)->pluck('name'))
        </x-card>
    </div>
    <div class="row mt-4">
        <x-card>
            <x-slot name="title">Most Active Last Month</x-slot>
            <x-slot name="subtitle">Users with most posts written in the last month.</x-slot>
            @slot('items',collect($mostActiveLastMonth)->pluck('name'))
        </x-card>                
    </div>                                
</div>