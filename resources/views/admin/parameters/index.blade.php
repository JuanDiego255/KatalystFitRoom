@extends('layouts.admin')
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Administra los parámetros para crear rutinas</strong>
        </h2>

        <hr class="hr-servicios">

        <button type="button" data-bs-toggle="modal" data-bs-target="#add-parameter-modal"
            class="btn bg-gradient-safewor-black text-white">Agregar Parámetro</button>

        <center>

            @include('admin.parameters.add')
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
                    <table id="parameters" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Categoría</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Cantidad</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Días</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parameters as $parameter)
                                <tr>

                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $parameter->gen_category }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $parameter->quantity }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $parameter->day }}</p>
                                    </td>


                                    <td class="align-middle">
                                        <center>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#edit-parameter-modal{{ $parameter->id }}"
                                                class="btn bg-gradient-safewor-black text-white"
                                                style="text-decoration: none;">Editar</button>
                                            <form method="post" action="{{ url('/parameter/delete/' . $parameter->id) }}"
                                                style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn bg-gradient-safewor-red text-white" type="submit"
                                                    onclick="return confirm('Deseas borrar este parámetro?')">Borrar
                                                </button>
                                            </form>
                                        </center>

                                    </td>
                                    @include('admin.parameters.edit')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </center>
    </div>
@endsection
@section('script')
    <script>
        var dataTable = $('#parameters').DataTable({
            searching: true,
            lengthChange: false,
            "order": [
                [2, "asc"]
            ],
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
