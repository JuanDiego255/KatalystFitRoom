@extends('layouts.admin')
@section('content')
    <h2 class="text-center font-title"><strong>Nuestros Usuarios</strong>
    </h2>

    <hr class="hr-servicios">


    <a href="{{ url('/register-user') }}" class="btn bg-gradient-safewor-red text-white">Nuevo Usuario</a>
    <h6>Es recomendable tener creados todos los ejercicios antes de generar las rutinas, ya que los ejercicios guardados
        recientemente, no aparecerán en las rutinas ya creadas, al menos que generen las rutinas desde 0.</h6>
    <center>
        <div class="row w-100">
            <div class="col-md-6">
                <div class="input-group input-group-lg input-group-static my-3 w-100">
                    <label>Filtrar</label>
                    <input value="" placeholder="Escribe para filtrar...." type="text"
                        class="form-control form-control-lg" name="searchfor" id="searchfor">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-lg input-group-static my-3 w-100">
                    <label>Mostrar</label>
                    <select id="recordsPerPage" name="recordsPerPage" class="form-control form-control-lg"
                        autocomplete="recordsPerPage">
                        <option value="5">5 Registros</option>
                        <option selected value="10">10 Registros</option>
                        <option value="25">25 Registros</option>
                        <option value="50">50 Registros</option>
                    </select>

                </div>
            </div>
        </div>
        <div class="card w-100 mb-4">
            <div class="table-responsive">
                <table id="users" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-left text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Usuario</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Cambio Rutina</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Peso</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Teléfono</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Acciones</th>
                            
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
                                <td class="align-middle text-xxs text-center">
                                    <h6 class="text-center mb-0">
                                        @if (isset($user->change_routine) && $user->change_routine <= $date)
                                            <span
                                                class="badge bg-gradient-danger animacion">{{ isset($user->change_routine) ? 'Fecha: ' . $user->change_routine : 'Sin Rutina' }}
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-gradient-info">{{ isset($user->change_routine) ? 'Fecha: ' . $user->change_routine : 'Sin Rutina' }}
                                            </span>
                                        @endif

                                    </h6>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <h6 class="text-center mb-0">{{ $user->weight }} Kg</h6>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <h6 class="text-center mb-0">{{ $user->telephone }}</h6>
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
                                                    class="btn bg-gradient-safewor-black text-white btn-tooltip"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Crear Rutina"
                                                    data-container="body" data-animation="true" type="submit">
                                                    <i class="material-icons opacity-10">add_circle</i></a>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ url('user/routine/' . $user->id) }}"
                                                class="btn bg-gradient-safewor-black text-white btn-tooltip"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Rutina"
                                                data-container="body" data-animation="true">
                                                <i class="material-icons opacity-10">visibility</i></a>
                                            <a href="{{ url('user/asign/' . $user->id) }}"
                                                class="btn bg-gradient-safewor-black text-white btn-tooltip"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar Rutina"
                                                data-container="body" data-animation="true">
                                                <i class="material-icons opacity-10">file_copy</i></a>
                                            <a href="{{ url('user/routine-day/' . $user->id) }}"
                                                class="btn bg-gradient-safewor-black text-white btn-tooltip"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Días De Rutina"
                                                data-container="body" data-animation="true">
                                                <i class="material-icons opacity-10">date_range</i></a>
                                            <a href="{{ url('create-word/' . $user->id) }}"
                                                class="btn bg-gradient-safewor-black text-white btn-tooltip"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar Rutina"
                                                data-container="body" data-animation="true">
                                                <i class="material-icons opacity-10">download</i></a>
                                            <form method="post" action="{{ url('/delete/routine/' . $user->id) }}"
                                                style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn bg-gradient-safewor-red text-white btn-tooltip"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Borrar Rutina" data-container="body" data-animation="true"
                                                    type="submit"
                                                    onclick="return confirm('Deseas borrar esta rutina (Se borrarán todas las rutinas existentes)?')">
                                                    <i class="material-icons opacity-10">delete_sweep</i>
                                                </button>
                                            </form>
                                        @endif


                                        <form method="post" action="{{ url('/delete/user/' . $user->id) }}"
                                            style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn bg-gradient-safewor-red text-white btn-tooltip"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar Usuario"
                                                data-container="body" data-animation="true" type="submit"
                                                onclick="return confirm('Deseas borrar este usuario?')"> <i
                                                    class="material-icons opacity-10">person_remove</i>
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

    </center>
@endsection
@section('script')
    <script>
        var dataTable = $('#users').DataTable({
            searching: true,
            lengthChange: false,
            "columnDefs": [{
                "targets": [3,4], // Índice de la columna que deseas deshabilitar (cambia 0 por el índice de tu columna)
                "orderable": false // Deshabilita la ordenación para la columna específica
            }, ],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "<<",
                    "sLast": "Último",
                    "sNext": ">>",
                    "sPrevious": "<<"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        $('#recordsPerPage').on('change', function() {
            var recordsPerPage = parseInt($(this).val(), 10);
            dataTable.page.len(recordsPerPage).draw();
        });

        // Captura el evento input en el campo de búsqueda
        $('#searchfor').on('input', function() {
            var searchTerm = $(this).val();
            dataTable.search(searchTerm).draw();
        });

    </script>
@endsection
