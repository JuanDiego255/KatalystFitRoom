<div class="row">
    <div class="col-md-12">

        <div class="input-group input-group-static">
            <label>Section</label>
            <select id="section" name="section"
                class="form-control form-control-lg @error('section') is-invalid @enderror" required
                autocomplete="section" autofocus>
                <option value="Inicio" selected>Inicio</option>

                <option value="Inicio">Inicio
                </option>
                <option value="Servicios">Servicios
                </option>

                <option value="Nosotros">Nosotros
                </option>
                <option value="Contacto">Contacto
                </option>
                <option value="Blog">Blog
                </option>
            </select>
            @error('section')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="input-group input-group-lg input-group-outline {{ isset($metatag->title) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Title</label>
            <input value="{{ isset($metatag->title) ? $metatag->title : '' }}" type="text"
                class="form-control form-control-lg @error('title') is-invalid @enderror" name="title" id="title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="input-group input-group-lg input-group-outline {{ isset($metatag->title) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Meta Keywords</label>
            <input value="{{ isset($metatag->meta_keywords) ? $metatag->meta_keywords : '' }}" type="text"
                class="form-control form-control-lg @error('meta_keywords') is-invalid @enderror" name="meta_keywords"
                id="meta_keywords">
            @error('meta_keywords')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="input-group input-group-lg input-group-outline {{ isset($metatag->title) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Meta Description</label>
            <input value="{{ isset($metatag->meta_description) ? $metatag->meta_description : '' }}" type="text"
                class="form-control form-control-lg @error('meta_description') is-invalid @enderror"
                name="meta_description" id="meta_description">
            @error('meta_description')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="input-group input-group-lg input-group-outline {{ isset($metatag->title) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Title OG</label>
            <input value="{{ isset($metatag->meta_og_title) ? $metatag->meta_og_title : '' }}" type="text"
                class="form-control form-control-lg @error('meta_og_title') is-invalid @enderror" name="meta_og_title"
                id="meta_og_title">
            @error('meta_og_title')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="input-group input-group-lg input-group-outline {{ isset($metatag->title) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Meta Description OG</label>
            <input value="{{ isset($metatag->meta_og_description) ? $metatag->meta_og_description : '' }}"
                type="text" class="form-control form-control-lg @error('meta_og_description') is-invalid @enderror"
                name="meta_og_description" id="meta_og_description">
            @error('meta_og_description')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="input-group input-group-lg input-group-outline {{ isset($metatag->title) ? 'is-filled' : '' }} my-3">
            <label class="form-label">URL Canonical</label>
            <input value="{{ isset($metatag->url_canonical) ? $metatag->url_canonical : '' }}" type="text"
                class="form-control form-control-lg @error('url_canonical') is-invalid @enderror" name="url_canonical"
                id="url_canonical">
            @error('url_canonical')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="input-group input-group-lg input-group-outline {{ isset($metatag->title) ? 'is-filled' : '' }} my-3">
            <label class="form-label">OG Image</label>
            <input value="{{ isset($metatag->url_image_og) ? $metatag->url_image_og : '' }}" type="text"
                class="form-control form-control-lg @error('url_image_og') is-invalid @enderror" name="url_image_og"
                id="url_image_og">
            @error('url_image_og')
                <span class="invalid-feedback" role="alert">
                    <strong>Campo Requerido</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="input-group input-group-lg input-group-outline {{ isset($metatag->title) ? 'is-filled' : '' }} my-3">
            <label class="form-label">Meta Type</label>
            <input value="{{ isset($metatag->meta_type) ? $metatag->meta_type : '' }}" type="text"
                class="form-control form-control-lg @error('meta_type') is-invalid @enderror" name="meta_type"
                id="meta_type">
            @error('meta_type')
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
