@extends('layouts.admin')
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Administra las disciplinas desde acá, datos reflejados al cliente</strong>
        </h2>

        <hr class="hr-servicios">
        <a href="{{ url('discipline/add') }}" class="btn bg-gradient-safewor-black text-white">Nueva Disciplina</a>

    </div>
    <center>
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Disciplina</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Descripción</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                               Imagen</th>                           
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Acciones</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($disciplines as $discipline)
                            <tr>
                                <td class="align-middle text-xxs text-left">
                                    <p class=" font-weight-bold mb-0">{{ $discipline->discipline }}</p>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <p class=" font-weight-bold mb-0">{{ $discipline->description }}</p>
                                </td>
                                <td class="align-middle text-xxs text-left">
                                    <img class="img-fluid img-thumbnail ml-2"
                                        src="{{ asset('storage') . '/' . $discipline->image }}" alt="" width="100">
                                </td>
                                
                                <td class="align-middle">
                                    <center>
                                        <a href="{{ url('discipline/edit/' . $discipline->id) }}"
                                            class="btn bg-gradient-safewor-black text-white">Editar</a>
                                        <form method="post" action="{{ url('/delete/discipline/' . $discipline->id) }}"
                                            style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn bg-gradient-safewor-black text-white" type="submit"
                                                onclick="return confirm('Deseas borrar esta disciplina?')">Borrar
                                            </button>
                                        </form>
                                    </center>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $disciplines ?? ('')->links('pagination::simple-bootstrap-4') }}


    </center>
@endsection
