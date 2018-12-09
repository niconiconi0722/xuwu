@if ($errors->any())
    <ul class="alert-black">
        @foreach ($errors->all() as $error)
            <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
        @endforeach
    </ul>
@endif
