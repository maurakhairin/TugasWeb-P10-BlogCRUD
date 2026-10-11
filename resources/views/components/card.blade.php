@props([
    'title' => null,
])

<div class="card">
    @if ($title)
        <div class="card-header">
            <h2>{{ $title }}</h2>
        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>
</div>