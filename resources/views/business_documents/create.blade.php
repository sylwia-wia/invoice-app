<x-layout>
    <h1>Dodaj nowy dokument handlowy</h1>
    @include('business_documents/_form', ['formAction' => route('business_documents.store')])
</x-layout>
