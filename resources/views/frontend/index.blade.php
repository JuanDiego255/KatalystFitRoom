@extends('layouts.front')
@section('metatag')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection
@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner mb-4">

            <div class="carousel-item">
                <div class="page-header min-vh-75 m-3 border-radius-xl"
                    style="background-image: url('images/carousel2.PNG');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 my-auto">
                                <h4 class="text-white mb-0 fadeIn1 fadeInBottom">El éxito es el resultado de pequeñas acciones diarias.</h4>
                                <h1 class="text-white fadeIn2 fadeInBottom">Estamos Ubicados en Creta, Grecia, Alajuela, CR</h1>
                                <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">No dudes en contactarnos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item active">
                <div class="page-header min-vh-75 m-3 border-radius-xl"
                    style="background-image: url('images/carousel1.PNG');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 my-auto">
                                <h4 class="text-white mb-0 fadeIn1 fadeInBottom">La disciplina es la base del éxito..</h4>
                                <h1 class="text-white fadeIn2 fadeInBottom">Katalyst Fit Room</h1>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="min-vh-75 position-absolute w-100 top-0">
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon position-absolute bottom-50" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon position-absolute bottom-50" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
    <h1 class="text-center text-dark">Nuestras Disciplinas</h1>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="owl-carousel featured-carousel owl-theme mt-3">
                    @foreach ($disciplines as $discipline)
                        <div class="item">
                            <div class="card" data-animation="true">

                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <a class="d-block blur-shadow-image">
                                        <img src="{{ asset('storage') . '/' . $discipline->image }}" alt="img-blur-shadow"
                                            class="img-fluid shadow border-radius-lg w-100" style="height:300px;">
                                    </a>
                                    <div class="colored-shadow"
                                        style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);">
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <div class="d-flex mt-n6 mx-auto">
                                        
                                    </div>
                                    <h5 class="font-weight-normal mt-3">
                                        <a href="{{url('detail-clothing/' . $discipline->id)}}">{{ $discipline->discipline }}</a>
                                    </h5>
                                    <p class="mb-0">
                                        {{ $discipline->description }}
                                    </p>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer d-flex">
                                    
                                   {{--  <i
                                        class="material-icons position-relative ms-auto text-lg me-1 my-auto">electric_bolt</i>
                                   
                                    <i class="material-icons position-relative ms-auto text-lg me-1 my-auto">inventory</i> --}}
                                   
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
