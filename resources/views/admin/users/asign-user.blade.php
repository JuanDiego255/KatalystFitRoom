@extends('layouts.admin')
@section('content')
    <div class="container w-75">


        <h2 class="text-center font-title"><strong>Usuarios Sin Rutina</strong>
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

                                            <form method="post" action="{{ url('/asign/routine/') }}"
                                                style="display:inline">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="id" name="id"
                                                    value="{{ $id }}">
                                                <input type="hidden" id="asign" name="asign"
                                                    value="{{ $user->id }}">

                                                <button class="btn bg-gradient-safewor-red text-white btn-tooltip"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar Rutina"
                                                    data-container="body" data-animation="true" type="submit">
                                                    Asignar Rutina</a>
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

            <div class="row">

                <div class="col-md-12 text-center">
                    <a href="{{ url('users') }}" class="btn bg-gradient-safewor-black text-white w-50">
                        {{ __('Cancelar') }}
                    </a>
                </div>

            </div>

            {{ $users ?? ('')->links('pagination::simple-bootstrap-4') }}


        </center>
    </div>
@endsection
