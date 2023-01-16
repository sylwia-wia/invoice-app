<x-layout>
    <h1>Edytuj dokument handlowy: {{ $businessDocument->number }}</h1>

    @include('business_documents/_form', ['formAction' => route('business_documents.update', [$businessDocument->id])])
</x-layout>



