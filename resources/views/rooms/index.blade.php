@extends('layouts.app')

@section('content')
    <div id="rooms-list">
        <ul>
            @each('rooms._room_list', $rooms, 'room')
        </ul>
    </div>

    <a href="{{ route('rooms.create') }}">新建房间</a>
@endsection

@section('script')
    <script>
        $('#rooms-list').on('click', function(event){
            var link = event.target.dataset.link;
            if (link) {
                attemptEnterRoom(link);
                return false;
            }
        });

        function attemptEnterRoom(link){
            $.ajax({
                url: link,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                success: function(re) {
                    if (re.success == true) {
                        window.location.href = re.link;
                    } else {
                        alert(re.message);
                    }
                }
            })
        }
    </script>
@endsection
