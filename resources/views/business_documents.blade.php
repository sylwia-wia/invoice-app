<x-layout>
    <h1>Dokumenty handlowe</h1>
    {{-- class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2" --}}
    <div class="float-start mb-4">
        <form method="GET" action="{{ route('business_document.create') }}">
            <button class="btn btn-dark">Dodaj nowy dokument handlowy</button>
        </form>
    </div>

    <div class="float-end mb-4">
        <form method="GET" action="#">
            <input type="text" name="searchBusinessDocument" placeholder="Znajdź dokument handlowy" class="form-control" value="{{ request('searchBusinessDocument') }}" />
        </form>
    </div>

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Typ dokumentu</th>
            <th scope="col">Numer</th>
            <th scope="col">Kontrahent</th>
            <th scope="col">Kwota netto</th>
            <th scope="col">VAT</th>
            <th scope="col">Kwota btutto</th>
            <th scope="col">Akcja</th>
        </tr>
        </thead>

        <tbody>
        <?php $index = 0; ?>
        @foreach ($business_documents as $business_document)
                <?php $index++ ?>

            <tr>
                <th scope="row">{{ $index }}</th>
                <td>{{ $business_document->documentType->name }}</td>
                <td>{{ $business_document->number }}</td>
                <td>{{ $business_document->contractor->name }}</td>
                <td>{{ $business_document->net_value }}</td>
                <td>{{ $business_document->vat }}</td>
                <td>{{ $business_document->gross_value }}</td>
                <td class="row g-2">
                    <form method="POST" action="{{ route('business_document.destroy', [$business_document->id]) }}" class="col-auto">
                        @csrf
                        <button class="btn btn-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </form>
                    <form method="POST" action="{{ route('business_document.edit', [$business_document->id]) }}" class="col-auto">
                        @csrf
                        <button class="btn btn-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

</x-layout>
