@extends('layouts.app')

@section('content')
    <div id="rooms-list">
        <div class="content-scroll">
            <table class="table table-hover">
                @each('rooms._room_list', $rooms, 'room')
            </table>
        </div>
    </div>

    @if (Auth::check())
        <a href="{{ route('rooms.create') }}" class="pull-right"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>
    @endif
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