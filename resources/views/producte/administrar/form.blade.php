<div class="w-full">
    <div class="flex flex-wrap">
        <h1 class="mb-5">{{ $title }}</h1>
    </div>
</div>

<form method="POST" action="{{ $route }}" enctype="multipart/form-data">
    @csrf

    @isset($update)
        @method("PUT")
    @endisset

    {{-- NOMBRE --}}
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input name="nom" type="text" class="form-control"
               value="{{ old('nom', $producte->nom ?? '') }}">

        @error('nom')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- PRECIO --}}
    <div class="mb-3">
        <label class="form-label">Preu</label>
        <input name="preu" type="number" step="0.01" class="form-control"
               value="{{ old('preu', $producte->preu ?? '') }}">

        @error('preu')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- IMAGEN --}}
    <div class="mb-3">
        <label class="form-label">Imatge</label>

        @if(!empty($producte->img))
            <div class="mb-2">
                <img src="{{ $producte->img }}" width="150">
            </div>
        @endif

        <input name="img" type="file" class="form-control">

        @error('img')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- BOTÓN --}}
    <button type="submit" class="btn btn-primary">
        {{ $textButton }}
    </button>
</form>