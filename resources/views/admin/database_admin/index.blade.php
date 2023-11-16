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
                    <label class="form-label">Compañía</label>
                    <input type="text" name="company" required id="company" value="" class="form-control w-100">
                </div>
            </div>

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
                <table id="companies" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Compañía</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Alias</th>                           
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>

                                <td class="align-middle text-xxs text-center">
                                    <p class=" font-weight-bold mb-0">{{ $company->company }}</p>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <p class=" font-weight-bold mb-0">{{ $company->alias }}</p>
                                </td>

                                <td class="align-middle">
                                    <center>
                                        

                                        <form method="post" action="{{ url('/delete/company/' . $company->id) }}"
                                            style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn bg-gradient-safewor-red text-white" type="submit"
                                                onclick="return confirm('Deseas borrar este ejercicio?')">Borrar
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
    </div>
@endsection
@section('script')
    <script>
        var dataTable = $('#companies').DataTable({
            searching: true,
            lengthChange: false,
            "columnDefs": [{
                "targets": [1], // Índice de la columna que deseas deshabilitar (cambia 0 por el índice de tu columna)
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
