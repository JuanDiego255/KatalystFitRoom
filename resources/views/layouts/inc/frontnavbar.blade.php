<nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
    id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <a href="{{ url('/') }}">
                <h4 class="font-weight-bolder mb-0">Katalyst Fit Room</h4>
            </a>

        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                {{-- <div class="input-group input-group-outline">
                    <label class="form-label">Search here</label>
                    <input type="text" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                </div> --}}
            </div>
            <ul class="navbar-nav  justify-content-end">
                @guest

                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                   
                    <li class="nav-item px-3">
                        <a href="{{ route('login') }}" class="nav-link text-body p-0">
                            Ingresar
                        </a>
                    </li>
                     <li class="nav-item px-3">
                        <a href="{{ url('register/user') }}" class="nav-link text-body p-0">
                            Registrarse
                        </a>
                    </li>
                    <li class="nav-item px-3">
                        <a href="{{ url('asist-index') }}" class="nav-link text-body p-0">
                            Asistencia
                        </a>
                    </li>
                   
                @else
                    <li class="nav-item px-3">
              
                   
                    <li class="nav-item dropdown pe-2">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                            <i
                                class="material-icons text-info position-relative ms-auto text-lg me-1 my-auto">keyboard_arrow_down</i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <div class="d-flex align-items-center py-1">
                                        <div class="my-auto">
                                            <span class="material-icons">
                                                logout
                                            </span>
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal mb-0">
                                                Salir
                                            </h6>
                                        </div>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item px-3">
                        <a href="{{ url('/my-routine') }}" class="nav-link text-body p-0">
                            Rutina
                        </a>
                    </li>
                     <li class="nav-item px-3">
                        <a href="{{ url('/create-word') }}" class="nav-link text-body p-0">
                            Descargar Rutina
                        </a>
                    </li>
                  
                @endguest

            </ul>
        </div>
    </div>
</nav>
