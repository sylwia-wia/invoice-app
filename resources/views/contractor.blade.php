<x-layout>
    <h1>Edytuj dane kontrahenta</h1>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" value="{{ $contractor->name }}">
        <label for="floatingInput">Nazwa</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="floatingInput" value="{{ $contractor->nip }}" >
        <label for="floatingInput">NIP</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" value="{{ $contractor->street }}">
        <label for="floatingInput">Ulica</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" value="{{ $contractor->town }}">
        <label for="floatingInput">Miasto</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" value="{{ $contractor->post_code }}">
        <label for="floatingInput">Kod pocztowy</label>
    </div>

    <button class="btn btn-outline-primary float-end">Zapisz</button>
</x-layout>
