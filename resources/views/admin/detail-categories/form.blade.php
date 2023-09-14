<div class="row">

    <div class="col-md-12 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($category->category) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Categoría</label>
            <input required value="{{ isset($category->category) ? $category->category : '' }}" type="text"
                class="form-control form-control-lg @error('category') is-invalid @enderror" name="category" id="category">
            @error('category')
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
