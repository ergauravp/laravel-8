@if(!isset($show) || $show)
    <span class="badge" style="background-color: {{ $color ? $color : 'green' }};">
        {{ $slot }}
    </span>
@endif