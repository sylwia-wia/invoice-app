<x-form.error/>

<form x-data="businessDocumentData(@js($businessDocument->positions ?? null))" method="POST" action="{{ $formAction }}"
      class="mt-10 ms-4">

    @isset($businessDocument)
        @method('PUT')
    @endisset

    @csrf


    <div class="form-floating mb-3">
        <select class="form-control" id="selectDocumentType" name="document[document_type_id]" required focus>
            <option value="" disabled @if (old('document_type_id') == null) selected @endif>Proszę wybrać typu
                dokumentu
            </option>

            @foreach($documentTypes as $key => $documentType)
                <option
                    value="{{ $documentType->id }}" {{ (old('document_type_id', $businessDocument->document_type_id ?? '') == $documentType->id ? 'selected' : ' ') }}> {{$documentType->name}}</option>
            @endforeach
        </select>
        <label for="floatingInput">Typ dokumentu</label>
    </div>
    <div class="input-group mb-3">
        <select class="form-control" name="document[contractor_id]" required focus>
            <option value="" disabled @if (old('contractor_id') == null) selected @endif>Proszę wybrać kontrahenta
            </option>

            @foreach($contractors as $key => $contractor)
                <option
                    value="{{$contractor->id}}" {{ (old('contractor_id', $businessDocument->contractor_id ?? '') == $contractor->id ? 'selected' : '') }} > {{ $contractor->name }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <x-form.show-modal-button
                button="btn btn-primary"
                action="{{ route('contractors.create') }}"> Dodaj </x-form.show-modal-button>
        </div>
    </div>

    <div class="form-floating mb-3">
        <input name="document[issue_date]" type="text" class="form-control" id="issue_date"
               value="{{ old('issue_date', $businessDocument->issue_date ?? '') }}">
        <label for="issue_date">Data wydania</label>
    </div>

    <div class="form-floating mb-3">
        <input name="document[sale_date]" type="text" class="form-control" id="sale_date"
               value="{{ old('sale_date', $businessDocument->sale_date ?? '') }}">
        <label for="sale_date">Data sprzedaży</label>
    </div>

    <div class="form-floating mb-3">
        <input name="document[payment_date]" type="text" class="form-control" id="payment_date"
               value="{{ old('payment_date', $businessDocument->payment_date ?? '') }}">
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

        <template x-for="index in Object.keys(positions)">
            @include('business_documents/_create_position')
        </template>
    </table>
    <x-form.button>Zapisz</x-form.button>
    <button class="btn btn-primary float-end me-2" @click="createNewPosition(); $event.preventDefault();">Dodaj</button>
</form>

<script>
    const VAT_RATES = '@json($vatRates)';
</script>
