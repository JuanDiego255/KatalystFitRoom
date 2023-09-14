@extends('layouts.front')
@section('content')
    <h1 class="text-center text-dark">Disfruta tu rutina!!</h1>
    <div class="py-5">
        <div class="container">
            <h6 class="text-left text-dark">La secuencia Alt, te indica el orden de los ejercicios, y con que debes alternar.
            </h6>
            <h6 class="text-left text-dark">La secuencia Series, te indica los Sets a realizar por ejercicio.</h6>
            <h6 class="text-left text-dark">La secuencia Reps, te indica la cantidad de repeticiones por ejercicio.</h6>
            <div class="row row-cols-1 row-cols-md-3 g-4 align-content-center card-group mt-5 mb-5">
                @foreach ($routines as $routine)
                    <div class="col bg-transparent">
                        <div class="card mb-5">

                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <a class="d-block blur-shadow-image">
                                    <img src="{{ asset('storage') . '/' . $routine->image }}" alt="img-blur-shadow"
                                        class="img-fluid shadow border-radius-lg w-100" style="height:300px;">
                                </a>
                                <div class="colored-shadow"
                                    style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);">
                                </div>
                            </div>
                            <div class="card-body text-center">

                                <h5 class="font-weight-normal mt-1">
                                    <a href="{{ url('#') }}">{{ $routine->gen_category }}</a>
                                </h5>
                                <p class="mb-0">
                                    Ejercicio: {{ $routine->exercise }}
                                </p>
                                @if ($routine->form)
                                    <p class="mb-0">
                                        Método: {{ $routine->form }}
                                    </p>
                                @endif

                                @if ($routine->description)
                                    <h5 class="font-weight-normal mt-1">
                                        Descripción
                                    </h5>
                                    {{ $routine->description }}
                                @endif
                                <h5 class="font-weight-normal mt-1">
                                    Peso (Kg)
                                </h5>
                                <center>
                                    <div class="input-group input-group-outline my-3 w-25 text-center">
                                        <input onkeypress="update(event,this.id,this.value,{{ $routine->id }})"
                                            type="text" min="0" name="weight" id="weight"
                                            value="{{ $routine->weight }}" class="form-control w-25">
                                    </div>                                   

                                    <div class="form-check">
                                        <input class="form-check-input text-danger" onchange="updateStatus(this.checked,{{ $routine->id }})"
                                        type="checkbox" value="" id="status"
                                        @if ($routine->completed == 1) checked="" @endif>
                                        <label class="custom-control-label" for="customCheck1">Ejercicio Realizado?</label>
                                    </div>
                                </center>

                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer d-flex">
                                <i class="material-icons position-relative text-lg me-1 my-auto">published_with_changes</i>
                                <p class="font-weight-normal my-auto">Series: {{ $routine->series }}
                                </p>
                                <i class="material-icons position-relative ms-auto text-lg me-1 my-auto">low_priority</i>
                                <p class="text-sm my-auto"> Alt: {{ $routine->alt }}</p>

                                <i class="material-icons position-relative ms-auto text-lg me-1 my-auto">replay</i>
                                <p class="text-sm my-auto"> Reps: {{ $routine->reps }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <center>
                <form class="form-horizontal" action="{{ url('/end-day/' . $id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <button class="btn bg-gradient-safewor-red text-white" type="submit">Finalizar Día
                    </button>
                </form>
            </center>

        </div>

    </div>
@endsection
@section('scripts')
    <script>
        function update(e, name, val, id) {
            if (e.keyCode === 13 && !e.shiftKey) {
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
                    'completed': 1,
                },
                success: function(response) {

                }
            });
        }
    </script>
@endsection
