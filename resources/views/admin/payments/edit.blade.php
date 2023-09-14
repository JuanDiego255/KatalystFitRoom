<div class="modal fade" id="edit-payment-modal{{ $payment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Editar Tipo De Pago</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ url('payments/' . $payment->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="col-md-12 mb-3">
                        <div
                            class="input-group input-group-lg input-group-outline {{ isset($payment->id) ? 'is-filled' : '' }} my-3">
                            <label class="form-label">Tipo De Pago</label>
                            <input required value="{{ isset($payment->type) ? $payment->type : '' }}" type="text"
                                class="form-control form-control-lg @error('type') is-invalid @enderror"
                                name="type" id="type">
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Campo Requerido</strong>
                                </span>
                            @enderror
                        </div>

                       
                    </div>
                   
                    <input class="btn bg-gradient-safewor-black text-white w-100 mt-3" type="submit" value="Guardar Cambios">
                </form>
            </div>
        </div>
    </div>
</div>
