@props(['name', 'type' => 'text', 'step' => null, 'xModel' => null, 'xChange' => null])

<div class="form-floating mb-3 " >
    <input
        name="{{ $name }}"
        type="{{ $type }}"
        @if ($step !== null) step="{{ $step }}" @endif
        @if ($xModel !== null) x-model="{{ $xModel }}" @endif
        @if ($xChange !== null) @change="{{ $xChange }}" @endif
        class="form-control align-middle"
        value="{{ old( '$name' ) }}"
    >
    <label for="floatingInput">{{ $slot }}</label>
</div>
