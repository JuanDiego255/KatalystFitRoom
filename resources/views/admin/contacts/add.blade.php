@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Creación de cuenta') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('register-create') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('name') is-filled @enderror">
                                        <label class="form-label">Nombre</label>
                                        <input id="name" type="text"
                                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required autocomplete="name"
                                            autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('identification') is-filled @enderror">
                                        <label class="form-label">Cédula</label>
                                        <input id="identification" type="text"
                                            class="form-control form-control-lg @error('identification') is-invalid @enderror"
                                            name="identification" value="{{ old('identification') }}" required autocomplete="identification"
                                            autofocus>

                                        @error('identification')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline @error('telephone') is-filled @enderror my-3">
                                        <label class="form-label">Teléfono</label>
                                        <input id="telephone" type="telephone"
                                            class="form-control form-control-lg @error('telephone') is-invalid @enderror"
                                            name="telephone" value="{{ old('telephone') }}" required
                                            autocomplete="telephone" autofocus>

                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group input-group-static">
                                        <label>Fecha De Nacimiento</label>
                                        <input type="date"
                                            class="form-control form-control-lg @error('birthdate') is-invalid @enderror"
                                            name="birthdate" id="birthdate">
                                        @error('birthdate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>Campo Requerido</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3 @error('email') is-filled @enderror">
                                        <label class="form-label">Correo</label>
                                        <input id="email" type="email"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3 @error('image') is-filled @enderror">
                                        <input id="image" class="form-control @error('image') is-invalid @enderror"
                                            type="file" name="image">
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">

                                    <div class="input-group input-group-static @error('gener') is-filled @enderror">
                                        <label>Género</label>
                                        <select id="gener" name="gener"
                                            class="form-control form-control-lg @error('gener') is-invalid @enderror"
                                            required autocomplete="local_id" autofocus>
                                            <option value="0" selected>Sin Especificar</option>

                                            <option value="1">Masculino
                                            </option>
                                            <option value="2">Femenino
                                            </option>

                                            </option>
                                        </select>
                                        @error('gener')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3 @error('password') is-filled @enderror">
                                        <label class="form-label">Contraseña</label>
                                        <input id="password" type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3 @error('password_confirmation') is-filled @enderror">
                                        <label class="form-label">Confirmar Contraseña</label>
                                        <input id="password-confirm" type="password" class="form-control form-control-lg"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn bg-gradient-btnsafewor-yellow text-dark w-50">
                                        {{ __('Crear Cuenta') }}
                                    </button>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
