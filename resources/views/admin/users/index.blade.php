@extends('layouts.admin')
@section('content')
    <h2 class="text-center font-title"><strong>Nuestros Usuarios</strong>
    </h2>

    <hr class="hr-servicios">

    <form class="form-inline">
        <div class="col-md-6 mb-3">
            <div class="input-group input-group-lg input-group-outline my-3">
                <label class="form-label">Filtrar (Presionar Enter)</label>
                <input value="" type="text" class="form-control form-control-lg" name="searchfor">

            </div>
        </div>
    </form>

    <a href="{{ url('/register-user') }}" class="btn bg-gradient-safewor-red text-white">Nuevo Usuario</a><br><br>

    <center>

        <div class="card w-100 mb-4">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-left text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Usuario</th>

                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Acciones</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>

                                <td class="align-middle text-xxs text-center">

                                    <div class="d-flex px-2 py-1 text-center">
                                        <div>
                                            <img src="{{ url('images/sin-foto.PNG') }} " class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-center mb-0">{{ $user->name }}</h6>

                                        </div>
                                    </div>

                                </td>

                                <td class="align-middle">
                                    <center>
                                        @if ($user->is_routine == 0)
                                            <form method="post" action="{{ url('/create/routine/') }}"
                                                style="display:inline">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="id" name="id"
                                                    value="{{ $user->id }}">
                                                <input type="hidden" id="type" name="type" value="0">
                                                <button
                                                    onclick="return confirm('Se creará la rutina con los ejercicios creados hasta ahora, desea continuar?')"
                                                    class="btn bg-gradient-safewor-black text-white" type="submit">Crear
                                                    Rutina
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ url('user/routine/' . $user->id) }}"
                                                class="btn bg-gradient-safewor-black text-white">Ver Rutina</a>
                                            <a href="{{ url('user/routine-day/' . $user->id) }}"
                                                class="btn bg-gradient-safewor-black text-white">Días De Rutina</a>
                                            <a href="{{ url('create-word/' . $user->id) }}"
                                                class="btn bg-gradient-safewor-black text-white">Descargar Rutina</a>
                                            <form method="post" action="{{ url('/delete/routine/' . $user->id) }}"
                                                style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn bg-gradient-safewor-red text-white" type="submit"
                                                    onclick="return confirm('Deseas borrar esta rutina (Se borrarán todas las rutinas existentes)?')">Borrar
                                                    Rutina
                                                </button>
                                            </form>
                                        @endif


                                        <form method="post" action="{{ url('/delete/user/' . $user->id) }}"
                                            style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn bg-gradient-safewor-red text-white" type="submit"
                                                onclick="return confirm('Deseas borrar este usuario?')">Borrar Usuario
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
        {{ $users ?? ('')->links('pagination::simple-bootstrap-4') }}


    </center>
@endsection
