@extends('layouts.admin')
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Administra los tipos de pago desde acá</strong>
        </h2>

        <hr class="hr-servicios">

        <button type="button" data-bs-toggle="modal" data-bs-target="#add-payments-modal"
            class="btn bg-gradient-safewor-black text-white">Nuevo Tipo</button><br><br>
    </div>
    <center>

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
                            $("#add-category-modal").modal('show');
                        });
                    } else {
                        $(document).ready(function() {
                            $("#edit-category-modal" + update_id).modal('show');
                        });
                    }

                }
                window.addEventListener('load', mostrarModal);
            </script>
        @endif
        @include('admin.payments.add')

        <div class="card w-75 mb-3">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Tipos De Pago</th>
                           
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Acciones</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="align-middle text-xxs text-center">
                                    <p class=" font-weight-bold mb-0">{{ $payment->type }}</p>
                                </td>                                

                                <td class="align-middle">
                                    <center>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#edit-payment-modal{{ $payment->id }}"
                                            class="btn bg-gradient-safewor-black text-white"
                                            style="text-decoration: none;">Editar</button>

                                        <form method="post" action="{{ url('/payments/delete/' . $payment->id) }}"
                                            style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn bg-gradient-safewor-red text-white" type="submit"
                                                onclick="return confirm('Deseas borrar esta categoría?')">Borrar
                                            </button>
                                        </form>
                                    </center>

                                </td>
                                @include('admin.payments.edit')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $payments ?? ('')->links('pagination::simple-bootstrap-4') }}


    </center>
@endsection
