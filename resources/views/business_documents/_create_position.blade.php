<tr x-data="documentData">
    <td>
        <div class="form-floating mb-3">
            <select x-on:change="getDataFromApi" class="form-control" name="position[{{ $index }}][product_id]" id="product-select" required>
                <option value="" disabled @if (old('product_id') == null) selected @endif>Proszę wybrać produkt</option>

                @foreach($products as $product)
                    <option value="{{$product->id}}" @if (old('product_id') == $product->id) selected @endif>{{ $product->name }}</option>
                @endforeach
            </select>
            <label >Produkt</label>
        </div>
    </td>

    <td>
        <input @change="calculateTaxes" x-model="price" name="position[{{ $index }}][net_price]" type="text" class="form-control" value="{{ old('net_price') }}" id="net-price-input">
    </td>

    <td>
        <input @change="calculateTaxes" x-model="quantity" name="position[{{ $index }}][quantity]" type="text" class="form-control" value="{{ old('quantity') }}">
    </td>

    <td>
        <div class="form-floating mb-3">
            <select x-model="unit" class="form-control" name="position[{{ $index }}][unit_id]" required focus >
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
            <select @change="calculateTaxes" x-model="vatRate" id="vat-rate-select" class="form-control" name="position[{{ $index }}][vat_rate_id]" required focus >
                <option value="" disabled @if (old('vat_rate_id') == null) selected @endif>Proszę wybrać stawkę VAT</option>

                @foreach($vatRates as $vatRate)
                    <option value="{{$vatRate->id}}" @if (old('vat_rate_id') == $vatRate->id) selected @endif>{{ $vatRate->rate }}%</option>
                @endforeach
            </select>
            <label>Stawka VAT</label>
        </div>
    </td>

    <td>
        <input x-model="vatValue" name="position[{{ $index }}][vat_value]" type="text" class="form-control" value="{{ old('vat_value')}}">
    </td>

    <td>
        <input x-model="grossValue" name="position[{{ $index }}][gross_value]" type="text" class="form-control" value="{{ old('gross_value') }}">
    </td>

</tr>
