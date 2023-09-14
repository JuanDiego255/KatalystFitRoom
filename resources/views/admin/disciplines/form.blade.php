<div class="row">

    <div class="col-md-6 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($discipline->discipline) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Disciplina</label>
            <input value="{{ isset($discipline->discipline) ? $discipline->discipline : '' }}" type="text"
                class="form-control form-control-lg @error('discipline') is-invalid @enderror" name="discipline" id="discipline">
            @error('discipline')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($discipline->description) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Descripción</label>
            <input value="{{ isset($discipline->description) ? $discipline->description : '' }}" type="text"
                class="form-control form-control-lg @error('discipline') is-invalid @enderror" name="description"
                id="description">
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        @if (isset($discipline->image))
            <img class="img-fluid img-thumbnail" src="{{ asset('storage') . '/' . $discipline->image }}"
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
