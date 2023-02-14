<div>
    <h1>Czy wysłać maila?</h1>

    <form method="POST" action="{{ route('email.send', [$business_document->id]) }}" class="mt-10 ms-4">
        @csrf
        <button class="btn btn-primary float-end ms-2">Wyślij</button>
    </form>
    <form method="GET" action="{{ route('business_documents.show', [$business_document->id]) }}" class="mt-10 ms-4">
        <button class="btn btn-secondary float-end">Anuluj</button>
    </form>
</div>
