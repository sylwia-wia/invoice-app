@if(session()->has('success'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert"
         x-data="{show: true}"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
        >
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert"
         x-data="{show: true}"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
    >
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
