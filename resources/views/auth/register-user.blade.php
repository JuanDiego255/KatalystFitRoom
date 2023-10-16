@extends('layouts.auth')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Creación de cuenta') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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
                                            name="identification" minlength="9" maxlength="9" value="{{ old('identification') }}" required
                                            autocomplete="identification" autofocus>

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
                                        <input onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                            maxlength="11" minlength="8" id="telephone" type="telephone"
                                            class="form-control form-control-lg @error('telephone')
is-invalid
@enderror"
                                            name="telephone" value="{{ old('telephone') }}" required
                                            autocomplete="telephone" autofocus>
                                       

                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline @error('whatsapp') is-filled @enderror my-3">
                                        <label class="form-label">WhatsApp</label>
                                        <input onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                            maxlength="11" minlength="8" id="whatsapp" type="whatsapp"
                                            class="form-control form-control-lg @error('whatsapp')
is-invalid
@enderror"
                                            name="whatsapp" value="{{ old('whatsapp') }}" autocomplete="whatsapp"
                                            autofocus>

                                        @error('whatsapp')
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
                                        <label class="form-label">Correo Electrónico</label>
                                        <input id="email" type="email"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('tutor') is-filled @enderror">
                                        <label class="form-label">Tutor</label>
                                        <input id="tutor" type="text"
                                            class="form-control form-control-lg @error('tutor') is-invalid @enderror"
                                            name="tutor" value="{{ old('tutor') }}" autocomplete="tutor"
                                            autofocus>

                                        @error('tutor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="input-group input-group-static @error('blood_type') is-filled @enderror">
                                        <label>Tipo Sangre</label>
                                        <select id="blood_type" name="blood_type"
                                            class="form-control form-control-lg @error('blood_type') is-invalid @enderror"
                                            required autocomplete="local_id" autofocus>
                                            <option value="Sin Especificar" selected>Sin Especificar</option>

                                            <option value="O+">O+
                                            </option>
                                            <option value="O-">O-
                                            </option>   
                                            <option value="A+">A+
                                            </option>
                                            <option value="A-">A-
                                            </option> 
                                            <option value="B+">B+
                                            </option>
                                            <option value="B-">B-
                                            </option>  
                                            <option value="AB+">AB+
                                            </option>
                                            <option value="AB-">AB-
                                            </option>    
                                        </select>
                                        @error('blood_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('address') is-filled @enderror">
                                        <label class="form-label">Dirección</label>
                                        <input id="address" type="text"
                                            class="form-control form-control-lg @error('address') is-invalid @enderror"
                                            name="address" value="{{ old('address') }}" autocomplete="address"
                                            autofocus>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('injuries') is-filled @enderror">
                                        <label class="form-label">Lesiones</label>
                                        <input id="injuries" type="text"
                                            class="form-control form-control-lg @error('injuries') is-invalid @enderror"
                                            name="injuries" value="{{ old('injuries') }}"
                                            autocomplete="injuries" autofocus>

                                        @error('injuries')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('sick') is-filled @enderror">
                                        <label class="form-label">Padecimientos</label>
                                        <input id="sick" type="text"
                                            class="form-control form-control-lg @error('sick') is-invalid @enderror"
                                            name="sick" value="{{ old('sick') }}" autocomplete="sick"
                                            autofocus>

                                        @error('sick')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Altura (cm)</label>
                                    <div
                                        class="input-group input-group-outline my-3 @error('height') is-filled @enderror">
                                        <input type="number" name="height" id="height" min="0"
                                            value="0" class="form-control w-25">
                                        @error('height')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Peso (kg)</label>
                                    <div
                                        class="input-group input-group-outline my-3 @error('weight') is-filled @enderror">
                                        <input type="number" name="weight" id="weight" min="0"
                                            value="0" class="form-control w-25">
                                        @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="input-group input-group-static @error('gender') is-filled @enderror">
                                        <label>Género</label>
                                        <select id="gender" name="gender"
                                            class="form-control form-control-lg @error('gender') is-invalid @enderror"
                                            autocomplete="local_id" autofocus>
                                            <option value="0" selected>Sin Especificar</option>

                                            <option value="1">Masculino
                                            </option>
                                            <option value="2">Femenino
                                            </option>

                                            </option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="anemia" id="anemia">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Padece de anemia en
                                            la actualidad?</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="suffocation"
                                            id="suffocation">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Se asfixia con
                                            facilidad al hacer ejercicio?</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="asthmatic" id="asthmatic">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Es asmático?</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="epileptic" id="epileptic">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Es
                                            epiléptico?</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="diabetic" id="diabetic">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Es diabético?</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="smoke" id="smoke">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Es usted
                                            fumador?</label>
                                    </div>
                                </div>

                                <h6 class="text-center mt-3">Indique si ha tenido alguno de los siguientes sintomas al
                                    realizar esfuerzos físicos</h6>

                                <div class="col-md-12">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('dizziness') is-filled @enderror">
                                        <label class="form-label">Mareos</label>
                                        <input id="dizziness" type="text"
                                            class="form-control form-control-lg @error('dizziness') is-invalid @enderror"
                                            name="dizziness" value="{{ old('dizziness') }}"
                                            autocomplete="dizziness" autofocus>


                                        @error('dizziness')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('fainting') is-filled @enderror">
                                        <label class="form-label">Desmayos</label>
                                        <input id="fainting" type="text"
                                            class="form-control form-control-lg @error('fainting') is-invalid @enderror"
                                            name="fainting" value="{{ old('fainting') }}"
                                            autocomplete="fainting" autofocus>


                                        @error('fainting')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('nausea') is-filled @enderror">
                                        <label class="form-label">Nauseas</label>
                                        <input id="nausea" type="text"
                                            class="form-control form-control-lg @error('nausea') is-invalid @enderror"
                                            name="nausea" value="{{ old('nausea') }}" autocomplete="nausea"
                                            autofocus>


                                        @error('nausea')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <h6 class="text-center mt-3">¿Realiza o ha realizado anteriormente alguna actividad física?
                                </h6>
                                <div class="col-md-12">
                                    <div
                                        class="input-group input-group-lg input-group-outline my-3  @error('sport_Activity') is-filled @enderror">
                                        <label class="form-label">Describir</label>
                                        <input id="sport_Activity" type="text"
                                            class="form-control form-control-lg @error('sport_Activity') is-invalid @enderror"
                                            name="sport_Activity" value="{{ old('sport_Activity') }}" autocomplete="sport_Activity"
                                            autofocus>


                                        @error('sport_Activity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="input-group input-group-lg input-group-outline @error('contact_emergency') is-filled @enderror my-3">
                                        <label class="form-label">Contacto De Emergencia</label>
                                        <input onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                            maxlength="11" minlength="8" id="contact_emergency" type="contact_emergency"
                                            class="form-control form-control-lg @error('contact_emergency')
is-invalid
@enderror"
                                            name="contact_emergency" value="{{ old('contact_emergency') }}"
                                            autocomplete="contact_emergency" autofocus>

                                        @error('contact_emergency')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn bg-gradient-safewor-red text-white w-50">
                                        {{ __('Crear Cuenta') }}
                                    </button>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-md-12 text-center">
                                    <a href="{{ url('/') }}" class="btn bg-gradient-safewor-black text-white w-50">
                                        {{ __('Volver') }}
                                    </a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
