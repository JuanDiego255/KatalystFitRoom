@extends('layouts.admin')
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Días de función de {{ $name }}</strong>
        </h2>

        <hr class="hr-servicios">



    </div>

    <center>


        <div class="card w-50 mb-4">
            <div class="product_data">

                <div class="table-responsive">
                    <input type="hidden" id="user_id" name="user_id" value="{{ $id }}">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Día</th>


                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Estado</th>

                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routine_days as $day)
                                <input type="hidden" class="routine_day_id" name="routine_day_id"
                                    value="{{ $day->id }}">
                                <tr>

                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">{{ $day->day }}</p>
                                    </td>


                                    <td class="align-middle text-xxs text-center">
                                        <p class=" font-weight-bold mb-0">

                                            <input onchange="updateStatus(this.checked,{{ $day->id }})" class="status"
                                                type="checkbox" value="" id="status"
                                                @if ($day->status == 1) checked="" @endif>

                                        </p>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
           
        </div>
        <a href="{{ url('users') }}" class="btn bg-gradient-safewor-red text-white w-25">
            {{ __('Volver') }}
        </a>


    </center>
@endsection
@section('script')
    <script>
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
                url: "/update-routine-day-status",
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
