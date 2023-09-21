<div class="modal fade-in" id="edit-product-modal{{ $product->id }}" tabindex="-1" role="dialog"
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
                <form class="form-horizontal" action="{{ url('products/update/' . $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="col-md-12 mb-3">

                        <div class="input-group input-group-static">
                            <label>Categoría</label>
                            <select id="category_id" name="category_id"
                                class="form-control form-control-lg @error('category_id') is-invalid @enderror" required
                                autocomplete="category_id" autofocus>
                                <option selected value="{{ $product->category_id }}">
                                    {{ $product->category }}

                                </option>

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
                            class="input-group input-group-lg input-group-outline {{ isset($product->product) ? 'is-filled' : '' }} my-3">
                            <label class="form-label">Producto</label>
                            <input required value="{{ isset($product->product) ? $product->product : '' }}"
                                type="text"
                                class="form-control form-control-lg @error('product') is-invalid @enderror"
                                name="product" id="product">
                            @error('product')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Campo Requerido</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div
                            class="input-group input-group-lg input-group-outline {{ isset($product->description) ? 'is-filled' : '' }} my-3">
                            <label class="form-label">Descripción</label>
                            <input required value="{{ isset($product->description) ? $product->description : '' }}"
                                type="text"
                                class="form-control form-control-lg @error('description') is-invalid @enderror"
                                name="description" id="description">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Campo Requerido</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div
                            class="input-group input-group-lg input-group-outline {{ isset($product->price) ? 'is-filled' : '' }} my-3">
                            <label class="form-label">Precio</label>
                            <input required value="{{ isset($product->price) ? $product->price : '' }}" type="number"
                                class="form-control form-control-lg @error('price') is-invalid @enderror" name="price"
                                id="price">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Campo Requerido</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div
                            class="input-group input-group-lg input-group-outline {{ isset($product->stock) ? 'is-filled' : '' }} my-3">
                            <label class="form-label">Stock</label>
                            <input value="{{ isset($product->stock) ? $product->stock : '' }}" type="number"
                                class="form-control form-control-lg @error('stock') is-invalid @enderror" name="stock"
                                id="stock">
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Campo Requerido</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        @if (isset($product->image))
                            <img class="img-fluid img-thumbnail" src="{{ asset('storage') . '/' . $product->image }}"
                                style="width: 150px; height:150px;" alt="image">
                        @endif
                        <div class="input-group input-group-lg input-group-outline my-3">
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                name="image" id="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Campo Requerido</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input class="btn bg-gradient-safewor-black text-white w-100 mt-3" type="submit"
                        value="Guardar Cambios">


                </form>
            </div>
        </div>
    </div>
</div>
