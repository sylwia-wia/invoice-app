@props(['name', 'type' => 'text', 'step' => null])

<div class="form-floating mb-3">
    <input name="{{ $name }}" type="{{ $type }}" @if ($step !== null) step="{{ $step }}" @endif  class="form-control" value="{{ old( '$name' ) }}">
    <label for="floatingInput">{{ $slot }}</label>
</div>
