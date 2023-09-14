@php
    $index = 0;
@endphp

<div class="row">
    <div class="col-md-12 mb-3">

        <div class="input-group input-group-static">
            <label>Categoría</label>
            <select required id="category_id" name="category_id"
                class="form-control form-control-lg @error('category_id') is-invalid @enderror"
                autocomplete="category_id" autofocus>

                @foreach ($categories as $cat)
                    <option @if ($index == 0) selected @endif value="{{ $cat->id }}">
                        {{ $cat->category }}
                    </option>
                    @php
                        $index = $index + 1;
                    @endphp
                @endforeach

            </select>
            @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($products->product) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Producto</label>
            <input required value="{{ isset($products->product) ? $products->product : '' }}" type="text"
                class="form-control form-control-lg @error('product') is-invalid @enderror" name="product"
                id="product">
            @error('product')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($products->description) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Descripción</label>
            <input required value="{{ isset($products->description) ? $products->description : '' }}" type="text"
                class="form-control form-control-lg @error('description') is-invalid @enderror" name="description"
                id="description">
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div
            class="input-group input-group-lg input-group-outline {{ isset($products->price) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Precio</label>
            <input required value="{{ isset($products->price) ? $products->price : '' }}" type="number"
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
            class="input-group input-group-lg input-group-outline {{ isset($products->stock) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Stock</label>
            <input value="{{ isset($products->stock) ? $products->stock : '' }}" type="number"
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
