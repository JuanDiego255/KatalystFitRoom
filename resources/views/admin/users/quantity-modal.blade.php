<div class="modal fade" id="quantity-exercises" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Cuántos ejercicios desea generar aleatoriamente?</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/create/routine/') }}" style="display:inline">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" name="id" value="{{ $id }}">
                    <input type="hidden" id="type" name="type" value="1">

                    <div class="col-md-12 mb-3">
                        <div class="input-group input-group-lg input-group-outline my-3">
                            
                            <input value="1" type="number" min="1"
                                class="form-control form-control-lg w-50 @error('quantity') is-invalid @enderror"
                                name="quantity" id="quantity" required>
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Campo Requerido</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn bg-gradient-safewor-red text-white" type="submit">Generar
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>
