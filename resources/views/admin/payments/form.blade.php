<div class="row">

    <div class="col-md-12 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($payment->type) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Tipo De Pago</label>
            <input required value="{{ isset($payment->type) ? $payment->type : '' }}" type="text"
                class="form-control form-control-lg @error('type') is-invalid @enderror" name="type" id="type">
            @error('type')
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
