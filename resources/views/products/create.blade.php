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

    <form method="POST" action="{{ route('product.create') }}" class="mt-10 ms-4">
        @csrf
        <h1>Dodaj nowy produkt/ usługę</h1>
        <div class="form-floating mb-3">
            <input name="name" type="text" class="form-control" id="floatingInput" value="{{ old('name') }}">
            <label for="floatingInput">Nazwa</label>
        </div>
        <div class="form-floating mb-3">
            <select class="form-control" id="selectVatRate" name="vat_rate_id" required focus >
                <option value="" disabled @if (old('vat_rate_id') == null) selected @endif>Proszę o wybranie stawki VAT</option>

                @foreach($vatRates as $vatRate)
                    <option value="{{$vatRate->id}}" @if (old('vat_rate_id') == $vatRate->id) selected @endif>{{ $vatRate->rate }}%</option>
                @endforeach
            </select>
            <label for="floatingInput">VAT</label>
        </div>
        <div class="form-floating mb-3">
            <input name="price" type="number" step="0.01" class="form-control" id="floatingInput" value="{{ old('price') }}">
            <label for="floatingInput">Cena jednostkowa</label>
        </div>


        <button type="submit" class="btn btn-outline-primary float-end">Zapisz</button>
    </form>
</x-layout>
