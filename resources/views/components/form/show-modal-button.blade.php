@props(['action', 'icon' => 'null', 'button' => 'btn btn-white'])

<a href="#" class="col-auto text-decoration-none show-modal" data-url="{{ $action }}" >
    <button class="{{ $button }}">
        <i class="{{ $icon }}"></i>
        {{ $slot }}
    </button>
</a>

