
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Fakturynka</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <meta name="theme-color" content="#712cf9">
</head>
<body>

<header>
    <div class="navbar navbar-dark navbar-expand-lg bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand align-items-center ">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <strong>Fakturynka</strong>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMainMenu" aria-controls="navbarMainMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMainMenu">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a href="invoices" class="nav-link">Faktury</a>
                    </li>
                    <li class="nav-item">
                        <a href="/contractors" class="nav-link">Kontrahenci</a>
                    </li>
                    <li class="nav-item">
                        <a href="/products" class="nav-link">Produkty/usługi</a>
                    </li>
                </ul>
                @auth
                    <ul class="navbar-nav mb-2 mb-md-0 float-end">
                        <li class="nav-item">
                            <span class="nav-link">Witaj, {{ auth()->user()->name }}</span>
                        </li>
                    </ul>
                    <form method="POST" action="/logout" class="ms-4">
                        @csrf
                        <button type="submit" class="btn btn-primary">Wyloguj się</button>
                    </form>
                @else
                    <ul class="navbar-nav mb-2 mb-md-0 float-end">
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Utwórz konto</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-md-0 float-end">
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Zaloguj się</a>
                        </li>
                    </ul>
                @endauth


            </div>
            </div>
        </div>
    </div>
</header>

<main>
        <div class="container">
            <div class="row mt-4">
                <div class="col">
                    <x-flash></x-flash>

                    {{ $slot }}
                </div>
            </div>

        </div>
</main>


</body>
</html>
