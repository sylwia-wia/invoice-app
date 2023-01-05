<x-layout>
    <x-form.error />

    <form method="POST" action="{{ route('product.create') }}" class="mt-10 ms-4">
        @csrf
        <h1>Dodaj nowy produkt/ usługę</h1>
        <x-form.input name="name">Nazwa</x-form.input>

        <div class="form-floating mb-3">
            <select class="form-control" id="selectUnit" name="unit_id" required focus >
                <option value="" disabled @if (old('unit_id') == null) selected @endif>Proszę o wybranie jednostki miary</option>

                @foreach($units as $unit)
                    <option value="{{$unit->id}}" @if (old('unit_id') == $unit->id) selected @endif>{{ $unit->name }}</option>
                @endforeach
            </select>
            <label for="floatingInput">Jednostka miary</label>
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

        <x-form.input name="price" type="number" step="0.01">Cena jednostkowa</x-form.input>

        <x-form.button>Zapisz</x-form.button>
    </form>
</x-layout>
