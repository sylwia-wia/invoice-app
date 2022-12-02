<x-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('contractor.create') }}" class="mt-10 ms-4">
        @csrf
        <h1>Dodaj nowego kontrahenta</h1>
        <div class="form-floating mb-3">
            <input name="name" type="text" class="form-control" id="floatingInput" value="{{ old('name') }}">
            <label for="floatingInput">Nazwa skrócona</label>
        </div>
        <div class="form-floating mb-3">
            <input name="company_name" type="text" class="form-control" id="floatingInput" value="{{ old('company_name') }}">
            <label for="floatingInput">Nazwa pełna</label>
        </div>
        <div class="form-floating mb-3">
            <input name="nip" type="number" class="form-control" id="floatingInput" value="{{ old('nip') }}">
            <label for="floatingInput">NIP</label>
        </div>
        <div class="form-floating mb-3">
            <input name="street" type="text" class="form-control" id="floatingInput" value="{{ old('street') }}">
            <label for="floatingInput">Ulica</label>
        </div>
        <div class="form-floating mb-3">
            <input name="locality" type="text" class="form-control" id="floatingInput" value="{{ old('locality') }}">
            <label for="floatingInput">Miasto</label>
        </div>
        <div class="form-floating mb-3">
            <input name="post_code" type="text" class="form-control" id="floatingInput" value="{{ old('post_code') }}">
            <label for="floatingInput">Kod pocztowy</label>
        </div>

        <button type="submit" class="btn btn-outline-primary float-end">Zapisz</button>
    </form>
</x-layout>
