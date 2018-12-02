<li>
    @if ($room->isFull())
        <span>{{ $room->name }}</span><a href="#" data-link="{{ route('rooms.knock', $room) }}">knock</a>
    @else
        <a href="#" data-link="{{ route('rooms.join', $room) }}">{{ $room->name }}</a>
    @endif
</li>