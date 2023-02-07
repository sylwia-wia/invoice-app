<form x-data="settlementData({{ $business_document->gross_value }}, {{ $business_document->getToSettled() }}, {{ $business_document->gross_settled }})" method="POST"
      action="{{ route('business_documents.settlement', [$business_document->id]) }}" class="mt-10 ms-4">
    @csrf
    <table>
        <tr>
            <th>Kwota do zapłaty bruttto</th>
            <td>{{ $business_document->gross_value }}</td>
        </tr>
        <tr>
            <th>Kwota rozliczona brutto</th>
            <td>{{ $business_document->gross_settled }}
            </td>

        </tr>

        <tr>
            <th>Kwota pozostała do zapłaty</th>
            <td>
                <input
                    name="gross_settled"
                    type="number"
                    step="0.01"
                    id="gross_settled"

                    class="form-control align-middle"
                    value="{{ $business_document->getToSettled() ?? 0 }}"
                >
            </td>
        </tr>


    </table>
    <x-form.button>Rozlicz</x-form.button>
</form>


