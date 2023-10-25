@extends('layouts.admin')
@section('content')
    <div class="container w-75">

        <h2 class="text-center font-title"><strong>Crear nueva compañía en base de datos Katalyst</strong>
        </h2>

        <hr class="hr-servicios">

        <form class="form-horizontal" action="{{ url('tables/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="col-md-12 mb-3">
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Alias</label>
                    <input type="text" name="alias" required id="alias" value="" class="form-control w-100">
                </div>
            </div>


            <center>
                <input class="btn bg-gradient-safewor-black text-white w-50" type="submit" value="Generar tablas">
            </center>

        </form>


    </div>
@endsection
