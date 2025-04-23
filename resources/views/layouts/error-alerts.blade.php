@if (session()->has('error'))
    <div class="alert alert-danger mb-3 mx-auto" style="width: 50%;" role="alert">
        {{ session('error') }}
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success mb-3 mx-auto" style="width: 50%;" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session()->has('status'))
    <div class="alert alert-info mb-3 mx-auto" style="width: 50%;" role="alert">
        {{ session('status') }}
    </div>
@endif
