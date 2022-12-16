@props(['name', 'type' => 'text'])

<div class="form-floating mb-3">
    <input name="{{ $name }}" type="{{ $type }}" class="form-control" id="floatingInput" value="{{ old( '$name' ) }}">
    <label for="floatingInput">{{ $slot }}</label>
</div>
