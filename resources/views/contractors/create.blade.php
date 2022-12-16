<x-layout>
    <x-form.error />

    <form method="POST" action="{{ route('contractor.create') }}" class="mt-10 ms-4">
        @csrf
        <h1>Dodaj nowego kontrahenta</h1>
        <x-form.input name="name">Nazwa skrócona</x-form.input>
        <x-form.input name="company_name">Nazwa pełna</x-form.input>
        <x-form.input name="nip" type="number">NIP</x-form.input>
        <x-form.input name="street">Ulica</x-form.input>
        <x-form.input name="locality">Miejscowość</x-form.input>
        <x-form.input name="post_code">Kod pocztowy</x-form.input>

        <x-form.button>Zapisz</x-form.button>
    </form>
</x-layout>
