<x-layout>
    <h1>Edytuj dane</h1>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" value="{{ $product->name }}">
        <label for="floatingInput">Nazwa</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="floatingInput" value="{{ $product->vat }}" >
        <label for="floatingInput">VAT</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="floatingInput" value="{{ $product->price }}">
        <label for="floatingInput">Cena</label>
    </div>

    <button class="btn btn-outline-primary float-end">Zapisz</button>
</x-layout>
