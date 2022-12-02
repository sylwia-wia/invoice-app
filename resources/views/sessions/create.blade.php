<x-layout>
    <section class="px-6 py-8 mt-4">
        <main class="w-50 mx-auto mt-10 bg-light border border-gray-200 p-10 rounded-2">
            <h1 class="text-center">Logowanie</h1>
            <form method="POST" action="{{ route('login.create') }}" class="mt-10 ms-4">
                @csrf

                <div class="mb-3 me-4">
                    <label class="form-label"
                           for="email">
                        Email
                    </label>
                    <input class="form-control"
                           type="email"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           required
                    >
                    @error('email')
                        <p class="text-danger mt-1" style="font-size: 12px">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3 me-4">
                    <label class="form-label"
                           for="password">
                        Hasło
                    </label>
                    <input class="form-control"
                           type="password"
                           name="password"
                           id="password"
                           required
                    >
                    @error('password')
                        <p class="text-danger mt-1" style="font-size: 12px">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3 me-4">
                    <button type="submit"
                            class="btn btn-dark py-2 px-4">
                        Zaloguj
                    </button>
                </div>
            </form>
        </main>
    </section>
</x-layout>
