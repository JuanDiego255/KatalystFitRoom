@extends('layouts.admin')
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Rutina de {{ $name }}</strong>
        </h2>

        <hr class="hr-servicios">



    </div>
    <form class="form-inline">
        <div class="col-md-6 mb-3">
            <div class="input-group input-group-lg input-group-outline my-3">
                <label class="form-label">Filtrar</label>
                <input value="" type="text" class="form-control form-control-lg" name="searchfor">

            </div>
        </div>


        <button class="btn bg-gradient-safewor-black text-white w-25 " type="submit">Buscar</button>
    </form>
    <h6>Puedes escribir en los campos de texto, luego presionar ENTER para guardar el valor.</h6>
    <center>


        <div class="card w-100 mb-4">
            <div class="product_data">

                <div class="table-responsive">
                    <input type="hidden" id="user_id" name="user_id" value="{{ $id }}">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Categoría General</th>

                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Ejercicio</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-5">
                                    Alt</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-5">
                                    Series</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-5">
                                    Repeticiones</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-5">
                                    Peso (Kg)</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-5">
                                    Forma</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Estado</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Día</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Descripción</th>

                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routines as $routine)
                                <input type="hidden" class="routine_id" name="routine_id" value="{{ $routine->id }}">
                                <tr @if ($routine->status != 1) class="" @endif>

                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $routine->gen_category }}</p>
                                    </td>

                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $routine->exercise }}</p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <div class="input-group input-group-outline my-3">
                                            <input onkeypress="update(event,this.id,this.value,{{ $routine->id }},'1')" onclick="update(event,this.id,this.value,{{ $routine->id }},'0')" type="number"
                                                name="alt" id="alt" min="0" value="{{ $routine->alt }}"
                                                class="form-control w-25">
                                        </div>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <div class="input-group input-group-outline my-3">
                                            <input onkeypress="update(event,this.id,this.value,{{ $routine->id }},'1')" onclick="update(event,this.id,this.value,{{ $routine->id }},'0')" type="number"
                                                name="series" id="series" min="0" value="{{ $routine->series }}"
                                                class="form-control w-25">
                                        </div>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <div class="input-group input-group-outline my-3">
                                            <input onkeypress="update(event,this.id,this.value,{{ $routine->id }},'1')" onclick="update(event,this.id,this.value,{{ $routine->id }},'0')" type="number"
                                                name="reps" id="reps" min="0" value="{{ $routine->reps }}"
                                                class="form-control w-25">
                                        </div>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <div class="input-group input-group-outline my-3">
                                            <input onkeypress="update(event,this.id,this.value,{{ $routine->id }},'1')" onclick="update(event,this.id,this.value,{{ $routine->id }},'0')" type="number"
                                                min="0" name="weight" id="weight" value="{{ $routine->weight }}"
                                                class="form-control w-25">
                                        </div>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <div class="input-group input-group-outline my-3">
                                            <input onkeypress="updateForm(event,this.value,{{ $routine->id }})"
                                                type="text" name="form" id="form" value="{{ $routine->form }}"
                                                class="form-control w-25">
                                        </div>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">

                                            <input onchange="updateStatus(this.checked,{{ $routine->id }})" class="status"
                                                type="checkbox" value="" id="status"
                                                @if ($routine->status == 1) checked="" @endif>

                                        </p>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <div class="input-group input-group-outline my-3">
                                            <input onclick="update(this.id,this.value,{{ $routine->id }})" type="number"
                                                name="day" id="day" min="0" max="{{ $max_day }}"
                                                value="{{ $routine->day }}" class="form-control w-25">
                                        </div>
                                    </td>
                                    <td class="align-middle text-xxs text-center">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#edit-description-modal{{ $routine->id }}"
                                            class="btn bg-gradient-safewor-red text-white"
                                            style="text-decoration: none;"><i class="material-icons opacity-10">edit_note</i></button>
                                    </td>



                                </tr>
                                @include('admin.users.form')
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        {{ $routines ?? ('')->links('pagination::simple-bootstrap-4') }}

    </center>
@endsection
@section('script')
    <script>
        function update(e,name, val, id,tipo) {
            var execute = 1;
            if(tipo == '1'){
                 if (e.keyCode !== 13 && !e.shiftKey) {
                     execute = 0;
                 }
            }
            
            if(execute==1){
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "/update-routine",
                    data: {
                        'name': name,
                        'val': val,
                        'id': id,
                    },
                    success: function(response) {
    
                    }
                });
            }
        }

        function updateForm(e, val, id) {
            if (e.keyCode === 13 && !e.shiftKey) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "/update-routine-form",
                    data: {

                        'val': val,
                        'id': id,
                    },
                    success: function(response) {

                    }
                });
            }

        }

        function updateStatus(val, id) {
            var status = 0;
            if (val) {
                status = 1;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/update-routine-status",
                data: {

                    'val': status,
                    'id': id,
                },
                success: function(response) {

                }
            });
        }
    </script>
@endsection
