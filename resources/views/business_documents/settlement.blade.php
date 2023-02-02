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
                <x-form.input name="gross_settled" type="number" step="0.01" id="gross_settled"
                              xModel="toSettlement" xChange="calculate"
                ></x-form.input>
            </td>
        </tr>

{{--                <tr>--}}
{{--                    <th>Kwota rozliczenia</th>--}}
{{--                    <td>--}}
{{--                        <x-form.input name="gross_settled" type="number" step="0.01" id="settlement"--}}
{{--                                      xModel="grossSettlement" xChange="calculate"--}}
{{--                        ></x-form.input>--}}

{{--                    </td>--}}
{{--                </tr>--}}


    </table>
    <x-form.button>Rozlicz</x-form.button>
</form>


