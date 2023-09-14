<div class="row">

    <div class="col-md-12 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($category->category) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Categoría</label>
            <input value="{{ isset($category->category) ? $category->category : '' }}" type="text"
                class="form-control form-control-lg @error('category') is-invalid @enderror" name="category" id="category">
            @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>   

    <div class="col-md-12 mb-3">
        @if (isset($category->image))
            <img class="img-fluid img-thumbnail" src="{{ asset('storage') . '/' . $category->image }}"
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
