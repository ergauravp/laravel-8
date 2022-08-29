<p class="text-muted">
    {{ (isset($slot) && trim($slot) != '') ? $slot : 'Added ' }} {{ $date }}
    @if(isset($name))
        @if(isset($userId))
            by <a href="{{ route('users.show', ['user' => $userId]) }}"> {{ $name }} </a>
        @else
            by {{ $name }}
        @endif
    @endif
</p>