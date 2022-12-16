<x-layout>
    <h1>Kontrahenci</h1>
    {{-- class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2" --}}
    <div class="float-start mb-4">
        <form method="GET" action="{{ route('contractor.create') }}">
            <button class="btn btn-dark">Dodaj nowego kontrahenta</button>
        </form>
    </div>

    <div class="float-end mb-4">
        <form method="GET" action="#">
            <input type="text" name="searchContractor" placeholder="Znajdź kontrahenta" class="form-control" value="{{ request('searchContractor') }}" />
        </form>
    </div>

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Nip</th>
            <th scope="col">Ulica</th>
            <th scope="col">Kod Pocztowy</th>
            <th scope="col">Miejscowość</th>
            <th scope="col">Akcja</th>
        </tr>
        </thead>

        <tbody>
        <?php $index = 0; ?>
        @foreach ($contractors as $contractor)
                <?php $index++ ?>

            <tr>
                <th scope="row">{{ $index }}</th>
                <td>{{ $contractor->id }}</td>
                <td>{{ $contractor->name }}</td>
                <td>{{ $contractor->nip }}</td>
                <td>{{ $contractor->street }}</td>
                <td>{{ $contractor->post_code }}</td>
                <td>{{ $contractor->locality }}</td>
                <td class="row g-2">
                    <x-form.edit-button action="{{ route('contractor.edit', [$contractor->id]) }}" />
                    <x-form.delete-button action="{{ route('contractor.destroy', [$contractor->id]) }}" />
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

</x-layout>
