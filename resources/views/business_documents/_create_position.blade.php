<tr>
    <td>

        <div class="form-floating mb-3">
            <select x-model="positions[index].product" x-on:change="getProductDataFromApi($event, index)" class="form-control" x-bind:name='`position[${index}][product_id]`' id="product-select" required>
                <option value="" disabled @if (old('product_id') == null) selected @endif>Proszę wybrać produkt</option>

                @foreach($products as $key => $product)
                    <option value="{{$product->id}}" {{ (old('product_id', $position->product_id ?? '') == $product->id ? 'selected' : '' ) }} >{{ $product->name }}</option>
                @endforeach
            </select>
            <label >Produkt</label>
        </div>
    </td>

    <td>
        <input @change="calculateTaxes(index)" x-model="positions[index].price" x-bind:name='`position[${index}][net_price]`' type="number" step="0.01" class="form-control" value="{{ old('net_price', $position->net_price ?? '') }}" id="net-price-input">
    </td>

    <td>
        <input @change="calculateTaxes(index)" x-model="positions[index].quantity" x-bind:name='`position[${index}][quantity]`' type="text" class="form-control" value="{{ old('quantity', $position->quantity ?? '') }}" id="quantity-input">
    </td>

    <td>
        <div class="form-floating mb-3">
            <select x-model="positions[index].unit" class="form-control" x-bind:name='`position[${index}][unit_id]`' required focus >
                <option value="" disabled @if (old('unit_id') == null) selected @endif>Proszę wybrać jednostkę miary</option>

                @foreach($units as $unit)
                    <option value="{{$unit->id}}" {{ (old('unit_id', $position->unit_id ?? '') == $unit->id ? 'selected' : '' ) }} >{{ $unit->name }}</option>
                @endforeach
            </select>
            <label>JM</label>
        </div>
    </td>

    <td>
        <div class="form-floating mb-3">
            <select @change="calculateTaxes(index)" x-model="positions[index].vatRate" id="vat-rate-select" class="form-control" x-bind:name='`position[${index}][vat_rate_id]`' required focus >
                <option value="" disabled @if (old('vat_rate_id') == null) selected @endif>Proszę wybrać stawkę VAT</option>

                @foreach($vatRates as $vatRate)
                    <option value="{{$vatRate->id}}" {{ (old('vat_rate_id', $position->vat_rate_id ?? '') == $vatRate->id ? 'selected' : '' ) }}>{{ $vatRate->rate }}%</option>
                @endforeach
            </select>
            <label>Stawka VAT</label>
        </div>
    </td>

    <td>
        <input x-model="positions[index].vatValue" x-bind:name='`position[${index}][vat_value]`' type="number" step="0.01" class="form-control" value="{{ old('vat_value', $position->vat_value ?? '') }}">
    </td>

    <td>
        <input x-model="positions[index].grossValue" x-bind:name='`position[${index}][gross_value]`' type="number" step="0.01" class="form-control" value="{{ old('gross_value', $position->gross_value ?? '') }}">
    </td>

    <td>
        <template x-if="index > 1" >
            <button  class="btn btn-danger" @click="removePosition(index); $event.preventDefault()">X</button>
        </template>
    </td>

</tr>
