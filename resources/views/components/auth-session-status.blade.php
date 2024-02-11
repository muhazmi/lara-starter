@props(['status'])

@if ($status)
    <div class="alert alert-success" role="alert">
        {{ $status }}
    </div>
@endif
