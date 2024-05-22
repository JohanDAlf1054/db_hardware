<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{{ $modo }}</title>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' >
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
            <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('css/estilosbarra.css') }}" type="text/css">
            <link rel="stylesheet" href="{{asset('css/estilos_accesibilidad.css')}}">
            <link href="{{ asset('css/estilos_footer.css')}}" rel="stylesheet">
            <script src="https://cdn.userway.org/widget.js" data-account="whmJm4JFhq"></script>
            <script src="{{asset('js/tooltips.js')}}" defer></script>
        </head>
        <body id="body">
            <header>
                <div class="icon__menu">
                    <i class='bx bx-menu' id="btn_open"></i>
                </div>
                <div class="titulo">
                    <h1>Ferretería la excelencia</h1>
                </div>

                {{--  <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split accesibilidad header-button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-universal-access fa-2xl icono_accesibilidad"></i>
                    <span class="visually-hidden">Accesibilidad</span>
                </button>
                <ul class="dropdown-menu">
                    <div class="acciones_boton">
                        <li><a class="dropdown-item" id="alto-contraste-button">Alto contraste <i class="fa-solid fa-palette"></i></a></li>
                        <li><a class="dropdown-item" id="font-larger-button">Aumentar letra <i class="fa-solid fa-plus"></i></a></li>
                        <li><a class="dropdown-item" id="font-smaller-button">Disminuir letra <i class="fa-solid fa-minus"></i></a></li>
                    </div>
                </ul>  --}}

            </header>

            <div class="menu__side" id="menu_side">

                <div class="name__page">
                    <i><img class="logos" src="{{ asset('img/LogoBlanco_Ferreteria.png') }}" alt=""></i>
                </div>

                <div class="options__menu">
                    <span id="liPanel" class="li" >Panel</span>
                    <div id="onlinePanel" class="online"></div>
                    <a tooltip="tooltip" data-bs-placement="right" title="Inicio" href="/home" class="{{ request()->route()->named('home') ? 'selected' : '' }}">
                        <div class="option">
                            <i class="fas fa-home"></i>
                            <h4>Inicio</h4>
                        </div>
                    </a>

                    <a tooltip="tooltip" data-bs-placement="right" title="Productos" href="{{ route('products.index') }}" class="{{ request()->route()->named('products.index') ? 'selected' : '' }}">
                        <div class="option">
                            <i class='bx bxs-package'></i>
                            <h4>Productos</h4>
                        </div>
                    </a>

                    <a tooltip="tooltip" data-bs-placement="right" title="Compras" href="{{ route('detail-purchases.index') }}" class="{{ request()->route()->named('purchase_supplier.index') ? 'selected' : '' }}">
                        <div class="option">
                            <i class='bx bxs-dollar-circle'></i>
                            <h4>Compras</h4>
                        </div>
                    </a>


                    <a tooltip="tooltip" data-bs-placement="right" title="Terceros" href="{{ route('person.index')}}" class="{{ request()->route()->named('person.index') ? 'selected' : '' }}">
                        <div class="option">
                            <i class='bx bxs-user-detail'></i>
                            <h4>Terceros</h4>
                        </div>
                    </a>

                    <a tooltip="tooltip" data-bs-placement="right" title="Ventas" href="{{route('sales.index')}}" class="{{ request()->route()->named('sales.index') ? 'selected' : '' }}">
                        <div class="option">
                            <i class='bx bxs-business'></i>
                            <h4>Ventas</h4>
                        </div>
                    </a>
                    <br>
                    <br>
                    <br>
                    <span id="liPanel1" class="li" >Cuenta</span>
                    <div id="onlinePanel1" class="online"></div>

                    {{--  Funcion para mostrar el link de roles solo para usuarios con el rol de administrador  --}}
                    @can('admin.usuarios.index')

                    <a tooltip="tooltip" data-bs-placement="right" title="Roles" href="{{ route('admin.usuarios.index') }}" class="{{ request()->route()->named('usuarios.index') ? 'selected' : '' }}">
                        <div class="option">
                                <i class="fa-solid fa-users-gear"></i>
                                <h4>Roles</h4>
                            </div>
                        </a>

                    @endcan
                    @can('/backup')
                    <a href="/backup" class="{{ request()->route()->named('/backup') ? 'selected' : '' }}">
                    {{-- @can('admin.backup.index') --}}
                    <a tooltip="tooltip" data-bs-placement="right" title="Copia de Seguridad" href="/backup" class="{{ request()->route()->named('/backup') ? 'selected' : '' }}">
                        <div class="option">
                            <i class="fa-solid fa-laptop-file"></i>
                            <h4>Copia de Seguridad</h4>
                        </div>
                    </a>
                    @endcan
                    <a href="/logout">
                    {{-- @endcan --}}
                    <a tooltip="tooltip" data-bs-placement="right" title="Cerrar Sesión" href="/logout">
                        <div class="option">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <h4>Cerrar Sesión </h4>
                        </div>
                    </a>
                </div>

            </div>
            <script src="{{ asset('js/acceso.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

            @include('include.footer')
        </body>
    </html>
