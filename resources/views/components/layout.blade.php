
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Fakturynka</title>






    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <meta name="theme-color" content="#712cf9">



</head>
<body>

<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand align-items-center ">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <strong>Fakturynka</strong>
            </a>
            <a href="invoices" class="navbar-brand align-items-center ">Faktury</a>
            <a href="/contractors" class="navbar-brand align-items-center ">Kontrahenci</a>
            <a href="/products" class="navbar-brand align-items-center">Produkty/usługi</a>

        </div>
    </div>
</header>

<main>
        <div class="container">
            <div class="row mt-4">
                <div class="col">
                    {{ $slot }}
                </div>
            </div>

        </div>
</main>

</body>
</html>
