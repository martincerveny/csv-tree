<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(session('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ session('alert-' . $msg) }}</p>
        @endif
    @endforeach
</div>
