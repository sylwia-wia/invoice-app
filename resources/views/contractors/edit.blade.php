<x-layout>
    <x-form.error />

    <form method="POST" action="{{ route('contractors.update', [$contractor->id]) }}" class="mt-10 ms-4">
        @method('put')
        @csrf
        <h1>Edytuj kontrahenta</h1>
        <div class="form-floating mb-3">
            <input name="name" type="text" class="form-control" id="floatingInput" value="{{ $contractor->name }}">
            <label for="floatingInput">Nazwa skrócona</label>
        </div>
        <div class="form-floating mb-3">
            <input name="company_name" type="text" class="form-control" id="floatingInput" value="{{ $contractor->company_name }}">
            <label for="floatingInput">Nazwa pełna</label>
        </div>
        <div class="form-floating mb-3">
            <input name="nip" type="number" class="form-control" id="floatingInput" value="{{ $contractor->nip }}">
            <label for="floatingInput">NIP</label>
        </div>
        <div class="form-floating mb-3">
            <input name="street" type="text" class="form-control" id="floatingInput" value="{{ $contractor->street }}">
            <label for="floatingInput">Ulica</label>
        </div>
        <div class="form-floating mb-3">
            <input name="locality" type="text" class="form-control" id="floatingInput" value="{{ $contractor->locality }}">
            <label for="floatingInput">Miasto</label>
        </div>
        <div class="form-floating mb-3">
            <input name="post_code" type="text" class="form-control" id="floatingInput" value="{{ $contractor->post_code }}">
            <label for="floatingInput">Kod pocztowy</label>
        </div>
        <div class="form-floating mb-3">
            <input name="email" type="text" class="form-control" id="floatingInput" value="{{ $contractor->email }}">
            <label for="floatingInput">Email</label>
        </div>

        <x-form.button>Zapisz</x-form.button>
    </form>
</x-layout>
