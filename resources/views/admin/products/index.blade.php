@extends('layouts.admin')
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Administra los productos desde acá</strong>
        </h2>

        <hr class="hr-servicios">

        <button type="button" data-bs-toggle="modal" data-bs-target="#add-products-modal"
            class="btn bg-gradient-safewor-black text-white">Nuevo Producto</button><br><br>

        <form class="form-inline">
            <div class="col-md-6 mb-3">
                <div class="input-group input-group-lg input-group-outline my-3">
                    <label class="form-label">Filtrar</label>
                    <input value="" type="text" class="form-control form-control-lg" name="searchfor">

                </div>
            </div>


            <button class="btn bg-gradient-safewor-black text-white w-25 " type="submit">Buscar</button>
        </form>


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
            @include('admin.products.add')
             
            <div class="card w-100 mb-4">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Categoría</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Producto</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Descripción</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Precio</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Stock</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Estado</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Imagen</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Acciones</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                           
                                <tr>

                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $product->category }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $product->product }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $product->description }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">₡ {{ number_format($product->price) }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $product->stock }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">
                                            @if ($product->status == 1)
                                                Activo
                                            @else
                                                Inactivo
                                            @endif
                                        </p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        @if (isset($product->image))
                                            <img class="img-fluid img-thumbnail"
                                                src="{{ asset('storage') . '/' . $product->image }}"
                                                style="width: 80px; height:80px;" alt="image">
                                        @else
                                            <img class="img-fluid img-thumbnail" src="{{ url('images/sin-foto.PNG') }} "
                                                style="width: 80px; height:80px;" alt="image">
                                        @endif
                                        <img class="img-fluid img-thumbnail ml-2"
                                            src="{{ asset('storage') . '/' . $product->image }}" alt=""
                                            width="100">
                                    </td>

                                    <td class="align-middle">
                                        <center>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#edit-product-modal{{ $product->id }}"
                                                class="btn bg-gradient-safewor-black text-white"
                                                style="text-decoration: none;">Editar</button>

                                            <form method="post" action="{{ url('products/delete/' . $product->id) }}"
                                                style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn bg-gradient-safewor-red text-white" type="submit"
                                                    onclick="return confirm('Deseas borrar este producto?')">Borrar
                                                </button>
                                            </form>
                                        </center>

                                    </td>
                                   
                                </tr>
                               @include('admin.products.edit')

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $products ?? ('')->links('pagination::simple-bootstrap-4') }}


        </center>
    </div>
@endsection
