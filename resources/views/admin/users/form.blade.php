<div class="modal modal-lg fade" id="edit-description-modal{{ $routine->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Editar Descripción</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ url('/update-description/routine/' . $routine->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}   
                    <input type="hidden" id="user_id" name="user_id" value="{{ $id }}"> 
                    <div class="col-md-12 mb-3">
                        <div
                            class="input-group input-group-lg input-group-outline {{ isset($routine->description) ? 'is-filled' : '' }} my-3">
                            <label class="form-label">Descripción</label>
                            <input value="{{ isset($routine->description) ? $routine->description : '' }}" type="text"
                                class="form-control form-control-lg @error('description') is-invalid @enderror"
                                name="description" id="description">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Campo Requerido</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input class="btn bg-gradient-safewor-black text-white w-100 mt-3" type="submit"
                        value="Guardar">


                </form>
            </div>
        </div>
    </div>
</div>
