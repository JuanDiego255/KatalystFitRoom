@extends('layouts.front')
@section('metatag')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Registro De Asistencias</strong>
        </h2>
        <hr class="dark horizontal my-0">
        <center>
            <div class="text-center card w-50 mt-3">                
    
                <div class="card-body">
                    <form method="POST" action="{{ url('asist') }}" enctype="multipart/form-data">
                        @csrf
    
                        <div class="row">
    
                            <div class="col-md-12">
                              
                                <div class="input-group input-group-lg input-group-static my-3  @error('identification') is-filled @enderror">
                                  
                                    <input id="identification" type="text" placeholder="Escriba aquí su cédula"
                                        class="form-control form-control-lg @error('identification') is-invalid @enderror" name="identification"
                                        value="{{ old('identification') }}" required autocomplete="identification" autofocus>
    
                                    @error('identification')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <center>
                            <input class="btn bg-gradient-safewor-black text-white w-50" type="submit"
                                value="Registrar Asistencia">
                        </center>
                    </form>
                </div>
            </div>
        </center>
        
    </div>
@endsection
