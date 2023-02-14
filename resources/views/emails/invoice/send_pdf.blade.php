<?php
/** @var \App\Models\BusinessDocument $businessDocument */
?>


<h2>Twoja faktura numer: {{ $businessDocument->number }} została wygenerowana</h2>
<p>Witaj {{ $businessDocument->company_name }}!!!</p>
<p>Dziękujemy za zaufanie i możliwość współpracy!</p>
<p>W załączniku przesyłamy  fakturę numer {{ $businessDocument->number }}</p>
<p>Kwota do zapłaty brutto to: {{ $businessDocument->gross_value }}</p>
<p>Termin zapłaty to: {{ $businessDocument->payment_date }}</p>
</br></br>
<p>Pozdrawiamy,</p>
<p>Fakturynka</p>

<p>-------------------------------------------------------------</p>
<footer>
    <p>Jeśli chcesz skontaktować się z nami w sprawie zamówienia możesz
        zadzwonić pod nr: 42 279 75 67 nasza infolinia jest czynna pon-pt w godzinach 8-17.</p>
</footer>
