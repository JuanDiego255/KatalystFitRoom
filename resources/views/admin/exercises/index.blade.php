@extends('layouts.admin')
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Administra los ejercicios desde acá</strong>
        </h2>

        <hr class="hr-servicios">

        <button type="button" data-bs-toggle="modal" data-bs-target="#add-exercise-modal"
            class="btn bg-gradient-safewor-black text-white">Nuevo Ejercicio</button>

        <center>
            @php
                $index = 0;
            @endphp
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    @php
                        $split = explode(' ', $error);

                        $last_word = $split[count($split) - 1];
                        $id = $split[count($split) - 2];

                    @endphp
                @endforeach
                <input type="hidden" id="last_word" name="last_word" value="{{ $last_word }}">
                <input type="hidden" id="update_id" name="update_id" value="{{ $id }}">

                <script>
                    function mostrarModal() {
                        var last_word = $("input[name=last_word]").val();
                        var update_id = $("input[name=update_id]").val();
                        if (last_word == 'store') {
                            $(document).ready(function() {
                                $("#add-exercise-modal").modal('show');
                            });
                        } else {
                            $(document).ready(function() {
                                $("#edit-exercise-modal" + update_id).modal('show');
                            });
                        }

                    }
                    window.addEventListener('load', mostrarModal);
                </script>
            @endif
            @include('admin.exercises.add')
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
                    <table id="exercises" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Categoría</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Ejercicio</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Imagen</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exercises as $exercise)
                                <tr>

                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $exercise->gen_category }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $exercise->exercise }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <img class="img-fluid img-thumbnail ml-2"
                                            src="@if ($exercise->image != null) {{ asset('storage') . '/' . $exercise->image }} @else
                                            {{ url('images/sin-foto.PNG') }} @endif"
                                            alt="" style="width: 80px; height:80px;">
                                    </td>

                                    <td class="align-middle">
                                        <center>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#edit-exercise-modal{{ $exercise->id }}"
                                                class="btn bg-gradient-safewor-black text-white"
                                                style="text-decoration: none;">Editar</button>

                                            <form method="post" action="{{ url('/delete/exercises/' . $exercise->id) }}"
                                                style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn bg-gradient-safewor-red text-white" type="submit"
                                                    onclick="return confirm('Deseas borrar este ejercicio?')">Borrar
                                                </button>
                                            </form>
                                        </center>

                                    </td>
                                    @include('admin.exercises.edit')
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
        var dataTable = $('#exercises').DataTable({
            searching: true,
            lengthChange: false,
            "columnDefs": [{
                "targets": [2,3], // Índice de la columna que deseas deshabilitar (cambia 0 por el índice de tu columna)
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
