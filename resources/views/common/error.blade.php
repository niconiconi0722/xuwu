@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
        @endforeach
    </ul>
@endif
