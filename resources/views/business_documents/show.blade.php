<x-layout>
    <x-form.error />
    <h1>Podgląd dokumentu: {{ $business_document->name, $business_document->number }}</h1>

    <table class="table mt-4">
        <tr>
            <th scope="col">Typ dokumentu</th>
            <td>{{ $business_document->documentType->name }}</td>
        </tr>

        <tr>
            <th scope="col">Numer</th>
            <td>{{ $business_document->number }}</td>
        </tr>

        <tr>
            <th scope="col">Kontrahent</th>
            <td>{{ $business_document->contractor->name }}</td>
        </tr>

        <tr>
            <th scope="col">Data wydania</th>
            <td>{{ $business_document->issue_date }}</td>
        </tr>

        <tr>
            <th scope="col">Data sprzedaży</th>
            <td>{{ $business_document->sale_date }}</td>
        </tr>

        <tr>
            <th scope="col">Data płatności</th>
            <td>{{ $business_document->payment_date }}</td>
        </tr>


        <tr class="mt-6">
            <th class="table-secondary">
                Pozycje dokumentu
            </th>
        </tr>

        <tr>
            <th>Produkt</th>
            <th>Cena netto</th>
            <th>Ilość</th>
            <th>JM</th>
            <th>Stawka VAT</th>
            <th>Wartość VAT</th>
            <th>Wartość brutto</th>
        </tr>

        @foreach($business_document->positions as $position)
            <tr>
                <td>{{ $position->product->name }}</td>
                <td>{{ $position->net_price }}</td>
                <td>{{ $position->quantity }}</td>
                <td>{{ $position->unit->name }}</td>
                <td>{{ $position->vatRate->rate}}%</td>
                <td>{{ $position->vat_value }}</td>
                <td>{{ $position->gross_value }}</td>
            </tr>
        @endforeach

        <tr>
            <th class="table-secondary">
                Podsumowanie
            </th>
        </tr>
        <tr>
            <th>Wartość netto</th>
            <th>Wartość VAT</th>
            <th>Wartość brutto</th>
        </tr>
        <tr>
            <td>{{ $business_document->net_value }}</td>
            <td>{{ $business_document->vat_value }}</td>
            <td>{{ $business_document->gross_value }}</td>
        </tr>
    </table>

    <a href="{{ route('business_documents.edit', [$business_document->id]) }}" class="col-auto text-decoration-none" >
        <button class="btn btn-primary">
            Edytuj
        </button>
    </a>

    <a href="{{ route('business_document.generatePDF', [$business_document->id]) }}" class="col-auto text-decoration-none" >
        <button class="btn btn-primary">
            Eksportuj do PDF
        </button>
    </a>

</x-layout>



