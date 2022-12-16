<x-layout>
    <x-form.error />

    <form method="POST" action="{{ route('business_documents.create') }}" class="mt-10 ms-4">
        @csrf
        <h1>Dodaj nowy dokument handlowy</h1>

        <div class="form-floating mb-3">
            <select class="form-control" id="selectDocumentType" name="document[document_type_id]" required focus >
                <option value="" disabled @if (old('document_type_id') == null) selected @endif>Proszę o wybranie typu dokumentu</option>

                @foreach($documentsTypes as $documentType)
                    <option value="{{$documentType->id}}" @if (old('document_type_id') == $documentType->id) selected @endif>{{ $documentType->name }}</option>
                @endforeach
            </select>
            <label for="floatingInput">Typ dokumentu</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-control" name="document[contractor_id]" required focus >
                <option value="" disabled @if (old('contractor_id') == null) selected @endif>Proszę wybrać kontrahenta</option>

                @foreach($contractors as $contractor)
                    <option value="{{$contractor->id}}" @if (old('document_type_id') == $contractor->id) selected @endif>{{ $contractor->name }}</option>
                @endforeach
            </select>
            <label >Typ dokumentu</label>
        </div>

        <div class="form-floating mb-3">
            <input name="document[number]" type="text" class="form-control" id="number" value="{{ old('number') }}">
            <label for="number">Numer dokumentu</label>
        </div>

        <div class="form-floating mb-3">
            <input name="document[issue_date]" type="text" class="form-control" id="issue_date" value="{{ old('issue_date') }}">
            <label for="issue_date">Data wydania</label>
        </div>

        <div class="form-floating mb-3">
            <input name="document[sale_date]" type="text" class="form-control" id="sale_date" value="{{ old('sale_date') }}">
            <label for="sale_date">Data sprzedaży</label>
        </div>

        <div class="form-floating mb-3">
            <input name="document[payment_date]" type="text" class="form-control" id="payment_date" value="{{ old('payment_date') }}">
            <label for="payment_date">Data płatności</label>
        </div>

        <h1>Pozycje dokumentu handlowego</h1>

        <table class="table">
            <tr>
                <th>Produkt</th>
                <th>Cena netto</th>
                <th>Ilość</th>
                <th>JM</th>
                <th>Stawka VAT</th>
                <th>Wartość VAT</th>
                <th>Wartość brutto</th>
            </tr>
            <tr>
                <td>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="position[product_id]" required>
                            <option value="" disabled @if (old('product_id') == null) selected @endif>Proszę wybrać produkt</option>

                            @foreach($products as $product)
                                <option value="{{$product->id}}" @if (old('product_id') == $product->id) selected @endif>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <label >Produkt</label>
                    </div>
                </td>

                <td>
                    <input name="position[net_price]" type="text" class="form-control" value="{{ old('net_price') }}">
                </td>

                <td>
                    <input name="position[quantity]" type="text" class="form-control" value="{{ old('quantity') }}">
                </td>

                <td>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="position[unit_id]" required focus >
                            <option value="" disabled @if (old('unit_id') == null) selected @endif>Proszę wybrać jednostkę miary</option>

                            @foreach($units as $unit)
                                <option value="{{$unit->id}}" @if (old('unit_id') == $unit->id) selected @endif>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        <label>JM</label>
                    </div>
                </td>

                <td>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="position[vat_rate_id]" required focus >
                            <option value="" disabled @if (old('vat_rate_id') == null) selected @endif>Proszę wybrać stawkę VAt</option>

                            @foreach($vatRates as $vatRate)
                                <option value="{{$vatRate->id}}" @if (old('vat_rate_id') == $vatRate->id) selected @endif>{{ $vatRate->rate }}%</option>
                            @endforeach
                        </select>
                        <label>Stawka VAT</label>
                    </div>
                </td>

                <td>
                    <input name="position[vat_value]" type="text" class="form-control" value="{{ old('vat_value') }}">
                </td>

                <td>
                    <input name="position[gross_value]" type="text" class="form-control" value="{{ old('gross_value') }}">
                </td>

            </tr>
        </table>



        <x-form.button>Zapisz</x-form.button>
    </form>
</x-layout>
