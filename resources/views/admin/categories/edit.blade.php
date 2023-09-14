<div class="modal fade" id="edit-category-modal{{ $category->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Editar Categoría</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ url('categories/update/' . $category->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="col-md-12 mb-3">
                        <div
                            class="input-group input-group-lg input-group-outline {{ isset($category->id) ? 'is-filled' : '' }} my-3">
                            <label class="form-label">Categoría</label>
                            <input value="{{ isset($category->category) ? $category->category : '' }}" type="text"
                                class="form-control form-control-lg @error('category') is-invalid @enderror"
                                name="category" id="category">
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
                    <input class="btn bg-gradient-safewor-black text-white w-100 mt-3" type="submit" value="Guardar Cambios">
                </form>
            </div>
        </div>
    </div>
</div>
