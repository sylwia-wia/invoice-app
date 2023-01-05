<x-layout>

    <div class="table-title">
        <h1>Produkty/Usługi</h1>
    </div>

    <div class="float-start mt-4 mb-4">
        <form method="GET" action="{{ route('product.create') }}">
            <button class="btn btn-dark">Dodaj nowy produkt/usługę</button>
        </form>
    </div>

    <div class="float-end mb-4">
        <form method="GET" action="#">
            <input type="text" name="searchProduct" placeholder="Znajdź produkt" class="form-control" value="{{ request('searchProduct') }}" />
        </form>
    </div>

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Nazwa</th>
            <th scope="col">JM</th>
            <th scope="col">VAT</th>
            <th scope="col">Cena</th>
            <th scope="col">Akcja</th>
        </tr>
        </thead>

        <tbody>
        <?php $index=0; ?>

        @foreach ($products as $product)
            <?php $index++ ?>
            <tr>
                <th scope="row">{{ $index }}</th>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->unit->name }}</td>
                <td>{{ $product->vatRate->rate }}%</td>
                <td>{{ $product->price }}</td>
                <td class="row g-2">
                    <x-form.edit-button action="{{ route('product.edit', [$product->id]) }}"/>
                    <x-form.delete-button action="{{ route('product.destroy', [$product->id]) }}"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-layout>
