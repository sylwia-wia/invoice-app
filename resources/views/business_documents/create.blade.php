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

            @for ($i = 0; $i <= 2; $i++)
                @include('business_documents/_create_position', ['index'  => $i])
            @endfor

        </table>
        <x-form.button>Dodaj nową pozycję</x-form.button>
        <x-form.button>Zapisz</x-form.button>
    </form>
</x-layout>

<script>
    const VAT_RATES = '@json($vatRates)';
</script>
