<tr>
    <td>
        <a href="{{ route('announcements.show', $announcement->id) }}">
            <div class="row">
                <span class="col-sm-6">{{ $announcement->title }}</span>
                <span class="col-sm-4">发布于{{ $announcement->updated_at }}</span>
                <div class="col-sm-2">
                    @can('destroy', $announcement)
                        <form action="{{ route('announcements.destroy', $announcement) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-black">删除</button>
                        </form>
                    @endcan
                </div>
            </div>
        </a>
    </td>
</tr>