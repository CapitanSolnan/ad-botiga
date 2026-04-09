<div class="w-full">
    <div class="flex flex-wrap">
        <h1 class="mb-5">{{ $title }}</h1>
    </div>
</div>

<form method="POST" action="{{ $route }}" enctype="multipart/form-data" class="needs-validation">
    @csrf
    @isset($update)
        @method("PUT")
    @endisset

    <div class="mb-3">
        <label for="nom" class="form-label">{{ __("Nom") }}</label>
        <input name="nom" type="text" class="form-control" value="{{ old('nom') ?? $producte->nom }}">
        @error("nom")
            <div class="fs-6 text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="preu" class="form-label">{{ __("Preu") }}</label>
        <input name="preu" type="number" step="0.01" class="form-control" value="{{ old('preu') ?? $producte->preu }}">
        @error("preu")
            <div class="fs-6 text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="img" class="form-label">{{ __("Imatge") }}</label>
        @if(isset($producte->img))
            <img src="{{ asset('storage/' . $producte->img) }}" alt="Imatge" class="mb-3" width="150">
        @endif
        <input name="img" type="file" class="form-control">
        @error("img")
            <div class="fs-6 text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <button class="btn btn-primary" type="submit">
            {{ $textButton }}
        </button>
    </div>
</form>