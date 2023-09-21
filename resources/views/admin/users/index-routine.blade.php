@extends('layouts.front')
@section('content')
    <h1 class="text-center text-dark">Mi Rutina</h1>
    <div class="py-5">
        <div class="container">

            <div class="row row-cols-1 row-cols-md-3 g-4 align-content-center card-group mt-5 mb-5">


                @foreach ($groupedCategories as $day => $categories)
                    <div class="col bg-transparent">
                        <div class="card mb-5">

                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <a class="d-block blur-shadow-image">
                                    <img @switch($day)
                                    @case(1)
                                    src="{{ url('images/dia_1.PNG') }}"
                                        @break
                                    @case(2)
                                    src="{{ url('images/dia_2.PNG') }}"
                                        @break
                                        @case(3)
                                        src="{{ url('images/dia_3.png') }}"
                                            @break
                                            @case(4)
                                            src="{{ url('images/dia_4.png') }}"
                                                @break
                                                @case(5)
                                                src="{{ url('images/dia_5.png') }}"
                                                    @break
                                    @default
                                    src="{{ url('images/dia_6.png') }}"
                                    @break                                                       
                                @endswitch
                                        alt="img-blur-shadow" class="img-fluid shadow border-radius-lg w-100"
                                        style="height:300px;">
                                </a>
                                <div class="colored-shadow"
                                    style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);">
                                </div>
                            </div>
                            <div class="card-body text-center">

                                <h4 class="mt-3">
                                    <a href="{{ url('go-routine/' . $day) }}">Empecemos!</a>
                                </h4>
                                <h5 class="font-weight-normal mb-0">
                                    Ejercicios del día {{ $day }}
                                </h5>
                                <hr class="dark horizontal my-0 mb-3">
                                @foreach ($categories as $category)
                                    <h6 class="mb-0">
                                        {{ $category }}
                                    </h6>
                                @endforeach

                                <hr class="dark horizontal my-0 mb-3">
                                @foreach ($days as $item)
                                    @if ($day == $item->day && $item->last_day == 1)
                                        <h6 class="mb-0">
                                            <span class="badge badge-pill badge-lg bg-gradient-success">Ultimo
                                                Realizado</span>
                                        </h6>
                                    @endif
                                @endforeach
                                @foreach ($days as $item)
                                    @if ($day == $item->day && $item->next_day == 1)
                                        <h6 class="mb-0">
                                            <span class="badge bg-gradient-danger animacion">Siguiente</span>
                                        </h6>
                                    @endif
                                @endforeach

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>



        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop: true,
            margin: 10,

            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
@endsection
