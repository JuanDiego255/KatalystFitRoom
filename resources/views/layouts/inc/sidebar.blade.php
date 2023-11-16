<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-safewor"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            {{-- <img src="{{ url('images/carousel1.png') }}" class="navbar-brand-img h-100" alt="main_logo"> --}}
            <h4 class="ms-1 font-weight-bold text-white">Safewors Solutions</h4>
        </a>
    </div>


    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
         {{--    <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('/meta-tags/indexadmin') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_offer</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Administrar Metatags</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('/disciplines') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">fitness_center</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Administrar Disciplinas</span>
                </a>
            </li>
            {{--     <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('#') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">library_books</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Administrar Blogs</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('#') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Administrar Usuarios</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('/categories') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Categoría General</span>
                </a>
            </li>

            <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('/exercises') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">fitness_center</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Ejercicios</span>
                </a>
            </li>
            <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('/users') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">group</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Usuarios</span>
                </a>
            </li>

           {{--  <li class="nav-item">
                <div class="dropdown">
                    <a href="javascript:;"
                        @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">inventory</i>
                        </div>
                        <span class="nav-link-text text-white ms-1">Productos </span><i
                            class="material-icons text-white">expand_more</i>

                    </a>
                    <center>
                        <ul class="ml-3 dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="ml-3 nav-item">
                                <a class="text-center dropdown-item" href="{{ url('/detail/category') }}">
                                    <div class="d-flex align-items-center py-0 ml-1 pl-2">
                                        <div class="my-auto">
                                            <span class="material-icons">
                                                category
                                            </span>
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal mb-0">
                                                Categorías
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="ml-3 nav-item">
                                <a class="text-center dropdown-item" href="{{ url('/products') }}">
                                    <div class="d-flex align-items-center py-0 ml-1 pl-2">
                                        <div class="my-auto">
                                            <span class="material-icons">
                                                inventory_2
                                            </span>
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal mb-0">
                                                Productos
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
    
                        </ul>
                    </center>
                  
                </div>
            </li> --}}
            {{-- <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('/parameters') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">settings</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Parámetros</span>
                </a>
            </li> --}}

          {{--   <li class="nav-item">
                <div class="dropdown">
                    <a href="javascript:;"
                        @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">money</i>
                        </div>
                        <span class="nav-link-text text-white ms-1">Facturación | Ventas </span><i
                            class="material-icons text-white">expand_more</i>

                    </a>
                    <center>
                        <ul class="ml-3 dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="ml-3 nav-item">
                                <a class="text-center dropdown-item" href="#">
                                    <div class="d-flex align-items-center py-0 ml-1 pl-2">
                                        <div class="my-auto">
                                            <span class="material-icons">
                                                attach_money
                                            </span>
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal mb-0">
                                                Ventas
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="ml-3 nav-item">
                                <a class="text-center dropdown-item" href="#">
                                    <div class="d-flex align-items-center py-0 ml-1 pl-2">
                                        <div class="my-auto">
                                            <span class="material-icons">
                                                add_card
                                            </span>
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal mb-0">
                                                Facturar
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="ml-3 nav-item">
                                <a class="text-center dropdown-item" href="{{ url('/payments') }}">
                                    <div class="d-flex align-items-center py-0 ml-1 pl-2">
                                        <div class="my-auto">
                                            <span class="material-icons">
                                                payments
                                            </span>
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal mb-0">
                                                Tipos De Pago
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
    
                        </ul>
                    </center>
                  
                </div>
            </li> --}}
            {{--   <li class="nav-item">
                <a @if ($view_name == 'admin_local_index') class="nav-link active text-white bg-gradient-btnVelvet" @else class="nav-link text-dark" @endif
                    href="{{ url('#') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">chat</i>
                    </div>
                    <span class="nav-link-text text-white ms-1">Lista De Mensajes</span>
                </a>
            </li> --}}
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn bg-gradient-btnsafewor text-dark mt-4 w-100" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Cerrar Sesion') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</aside>
