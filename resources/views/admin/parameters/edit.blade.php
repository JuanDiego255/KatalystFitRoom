<div class="modal fade" id="edit-parameter-modal{{ $parameter->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Editar Parámetro</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ url('parameter/update/' . $parameter->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="col-md-12 mb-3">

                        <div class="input-group input-group-static">
                            <label>Categoría</label>
                            <select id="general_category_id" name="general_category_id"
                                class="form-control form-control-lg @error('general_category_id') is-invalid @enderror"
                                required autocomplete="general_category_id" autofocus>

                                @foreach ($categories as $cat)
                                    <option @if ($cat->id == $parameter->gen_category_id) selected @endif
                                        value="{{ $cat->id }}">
                                        {{ $cat->category }}
                                    </option>                                    
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
                        <div class="input-group input-group-static my-3">
                            <label>Cantidad</label>
                            <input value="{{ isset($parameter->quantity) ? $parameter->quantity : '' }}" type="number" min="1" name="quantity" required id="quantity" value="1"
                                class="form-control w-100">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="input-group input-group-static my-3">
                            <label>Día</label>
                            <input value="{{ isset($parameter->day) ? $parameter->day : '' }}" type="number" min="1" name="day" required id="day" value="0"
                                class="form-control w-100">
                        </div>
                    </div>

                    <input class="btn bg-gradient-safewor-black text-white w-100 mt-3" type="submit"
                        value="Guardar Cambios">


                </form>
            </div>
        </div>
    </div>
</div>
