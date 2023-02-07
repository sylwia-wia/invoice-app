<x-layout x-data="{'isModalOpen': false}" x-on:keydown.escape="isModalOpen:false">
    <h1>Dokumenty handlowe</h1>
    <div class="float-start mb-4">
        <form method="GET" action="{{ route('business_documents.create') }}">
            <button class="btn btn-dark">Dodaj nowy dokument handlowy</button>
        </form>
    </div>

    <div class="float-end mb-4">
        <form method="GET" action="#">
            {{ csrf_field() }}
            <input type="text" name="search" placeholder="Znajdź dokument handlowy" class="form-control" value="{{ request('search')  }}" />
        </form>
    </div>

    <table class="table mt-4">
        <thead>
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Typ dokumentu</th>
            <th class="text-center" scope="col">Numer</th>
            <th class="text-center" scope="col">Kontrahent</th>
            <th class="text-center" scope="col">Wartość netto</th>
            <th class="text-center" scope="col">Wartość VAT</th>
            <th class="text-center" scope="col">Wartość brutto</th>
            <th class="text-center" scope="col">Akcja</th>
        </tr>
        </thead>

        <tbody>
        <?php $index = 0; ?>
        @foreach ($business_documents as $business_document)
                <?php $index++ ?>

            <tr class="{{ $business_document->isSettled() ? 'table-success' : 'table-warning' }}">
                <th class="text-center" scope="row">{{ $index }}</th>
                <td class="text-center">{{ $business_document->documentType->name }}</td>
                <td class="text-center">{{ $business_document->number }}</td>
                <td class="text-center">{{ $business_document->contractor->name }}</td>
                <td class="text-center">{{ $business_document->net_value }}</td>
                <td class="text-center">{{ $business_document->vat_value }}</td>
                <td class="text-center">{{ $business_document->gross_value }}</td>
                <td class="text-end">
                    <x-form.show-modal-button action="{{ route('business_documents.settlement_form', [$business_document->id]) }}" icon="bi bi-currency-dollar"/>
                    <x-form.show-button action="{{ route('business_documents.show', [$business_document->id]) }}"/>
                    <x-form.delete-button action="{{ route('business_documents.destroy', [$business_document->id]) }}" />
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

</x-layout>
