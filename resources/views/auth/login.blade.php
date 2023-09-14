@extends('layouts.front')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Iniciar Sesión') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                        

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="input-group input-group-lg input-group-static ">
                                        <label>Cédula</label>
                                        <input placeholder="Escribe aquí...." id="password" type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <button type="submit" class="btn bg-gradient-btnsafewor-yellow text-dark w-75">
                                        {{ __('Ingresar') }}
                                    </button>


                                </div>
                                <div class="col-md-6 text-center">
                                    <a href="{{ url('/') }}" class="btn bg-gradient-safewor-black text-white w-75">
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
