{{ $user->username }}
@can('destroy', $user)
    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit">删除</button>
    </form>
@endcan

@can('authorityEdit', $user)
    <form action="{{ route('users.authority', $user->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        @if($user->authority == 0)
            <input type="hidden" value="1" name="authority_edit">
            <button type="submit">设为管理员</button>
        @else
            <input type="hidden" value="0" name="authority_edit">
            <button type="submit">取消管理员</button>
        @endif
    </form>
@endcan
