@php
    $index = 0;
@endphp

<div class="row">
    <div class="col-md-12 mb-3">

        <div class="input-group input-group-static">
            <label>Categoría</label>
            <select id="general_category_id" name="general_category_id"
                class="form-control form-control-lg @error('general_category_id') is-invalid @enderror" required
                autocomplete="general_category_id" autofocus>

                @foreach ($categories as $cat)
                    <option @if ($index == 0) selected @endif value="{{ $cat->id }}">
                        {{ $cat->category }}
                    </option>
                    @php
                        $index = $index + 1;
                    @endphp
                @endforeach

            </select>
            @error('general_category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($exercise->exercise) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Ejercicio</label>
            <input value="{{ isset($exercise->exercise) ? $exercise->exercise : '' }}" type="text"
                class="form-control form-control-lg @error('exercise') is-invalid @enderror" name="exercise"
                id="exercise">
            @error('exercise')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-md-12 mb-3">
        @if (isset($exercise->image))
            <img class="img-fluid img-thumbnail" src="{{ asset('storage') . '/' . $exercise->image }}"
                style="width: 150px; height:150px;" alt="image">
        @endif
        <div class="input-group input-group-lg input-group-outline my-3">
            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                id="image">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>

    <center>
        <input class="btn bg-gradient-safewor-black text-white w-50" type="submit"
            value="{{ $Modo == 'crear' ? 'Agregar' : 'Guardar Cambios' }}">
    </center>

</div>
