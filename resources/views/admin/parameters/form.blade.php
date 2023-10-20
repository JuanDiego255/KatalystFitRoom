@php
    $index = 0;
@endphp

<div class="row">
    <div class="col-md-12 mb-3">

        <div class="input-group input-group-static">
            <label>Categoría</label>
            <select id="general_category_id" name="general_category_id"
                class="form-control form-control-lg @error('general_category_id') is-invalid @enderror" required
                autocomplete="general_category_id" autofocus>

                @foreach ($categories as $cat)
                    <option @if ($index == 0) selected @endif value="{{ $cat->id }}">
                        {{ $cat->category }}
                    </option>
                    @php
                        $index = $index + 1;
                    @endphp
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
            <input type="number" min="1" name="quantity" required id="quantity" value="1"
                class="form-control w-100">
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="input-group input-group-static my-3">
            <label>Día</label>
            <input type="number" min="1" name="day" required id="day" value="0"
                class="form-control w-100">
        </div>
    </div>
  

    <center>
        <input class="btn bg-gradient-safewor-black text-white w-50" type="submit"
            value="Guardar Parámetro">
    </center>

</div>
