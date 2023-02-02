<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Business Document</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>
<style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    body {
        position: relative;
        width: 18cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: DejaVu Sans, serif;
        font-size: 12px;
    }

    header {
        padding: 10px 0;
        margin-bottom: 30px;
    }

    h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
    }

    #seller {
        float: left;
    }

    #buyer {
        float: right;
        text-align: left;
    }

    #seller div,
    #buyer div {
        white-space: nowrap;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
    }

    table tr:nth-child(2n-1) td {
        background: #F5F5F5;
    }

    table th,
    table td {
        text-align: center;
    }

    table th {
        padding: 5px 5px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
    }

    table .desc {
        text-align: center;
    }

    table td {
        padding: 20px;
        text-align: center;
    }

    table td.desc {
        vertical-align: top;
    }


    table td.total {
        font-size: 1.2em;
    }

    table td.grand {
        border-top: 1px solid #5D6975;;
    }

    #invoice-date {
        margin-bottom: 10px;
    }


</style>
<body>
<header class="clearfix">

    <div id="invoice-date">
        <div><b>DATA WYSTAWIENIA</b> {{ $businessDocument->issue_date }}</div>
        <div><b>DATA WYDANIA</b> {{ $businessDocument->sale_date }}</div>
        <div><b>DATA PŁATNOŚCI</b> {{ $businessDocument->payment_date }}</div>
    </div>
    <h1>INVOICE {{ $businessDocument->number }}</h1>
    <div id="buyer" class="clearfix">
        <div><b>NABYWCA</b> </div>
        <div>{{ $businessDocument->contractor->company_name }}</div>
        <div>{{ $businessDocument->contractor->street }}<br/>
            {{ $businessDocument->contractor->post_code }}  {{ $businessDocument->contractor->locality }}
        </div>

    </div>
    <div id="seller">
        <div><b>SPRZEDAWCA</b> </div>
        <div>mk-home.pl</div>
        <div>Ciołkowskiego 22<br /> 14-254 Białystok</div>
    </div>
</header>

<main>
    <table>
        <thead>
        <tr>
            <th class="desc">LP</th>
            <th class="desc">PRODUKT</th>
            <th class="desc">ILOŚĆ</th>
            <th class="desc">JM</th>
            <th class="desc">STAWKA VAT</th>
            <th class="desc">WARTOŚĆ VAT</th>
            <th class="desc">WARTOŚĆ BRUTTO</th>
        </tr>
        </thead>
        <tbody>
            @foreach($businessDocument->positions as $position)
                <tr>
                    <td>{{ $position->product->name }}</td>
                    <td>{{ $position->net_price }}</td>
                    <td>{{ $position->quantity }}</td>
                    <td>{{ $position->unit->name }}</td>
                    <td>{{ $position->vatRate->rate}}%</td>
                    <td>{{ $position->vat_value }}</td>
                    <td>{{ $position->gross_value }}</td>
                </tr>
            @endforeach



        <tr>
            <td colspan="4">WARTOSĆ NETTO</td>
            <td class="total">{{ $businessDocument->net_value }}</td>
        </tr>

            @foreach($businessDocument->getVatValuesDividedByRates() as $vatRate => $vatRateValue)
                <tr>
                    <td colspan="4">Stawka VAT {{ $vatRate }}%</td>
                    <td class="total">{{ $vatRateValue }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4">WARTOŚĆ VAT RAZEM</td>
                <td class="total">{{ $businessDocument->vat_value }}</td>
            </tr>

        <tr>
            <td colspan="4" class="grand total">WARTOŚĆ BRUTTO</td>
            <td class="grand total">{{ $businessDocument->gross_value }}</td>
        </tr>
        </tbody>
    </table>


</main>


</body>
</html>
