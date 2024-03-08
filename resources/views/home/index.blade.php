@auth
@include('include.barra')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Acceso Directo</title>
        <link rel="stylesheet" href="css/accesos_directos.css" />
        <link rel="stylesheet" href="css/estilosbarra.css" />
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
        <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </head>
    <body id="body">

    <header>
        <div class="icon__menu">
            <i class='bx bx-menu'id="btn_open"> </i>
        </div>
        <div class="log-modify">
            <i class='bx bx-store-alt' ></i>
        </div>
        <div class="titulo">
            <h1>Ferreteria la excelencia</h1>
        </div>
        <button id="settings-button">
            <i class="bx bx-cog"></i>
        </button>

        <ul id="settings-menu" style="display: none;">
            <li><a href="#">Cerrar sesión</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </header>
    </div>
    <div class="menu__side" id="menu_side">
        <div class="name__page">
            <i><img class="logos" src="./img/Logo.png" alt="" /></i>
        </div>

        <div class="options__menu">
            <a href="#" class="selected">
                <div class="option">
                <i class='bx bxs-home' ></i>
                <h4>Inicio</h4>
                </div>
            </a>

            <a href="{{ route('products.index') }}">
                <div class="option">
                    <i class="bx bxs-package" title="Productos"></i>
                    <h4>Productos</a></h4>
                </div>
            </a>

            <a href="Compras.html">
                <div class="option">
                    <i class="bx bxs-dollar-circle" title="compras"></i>
                    <h4>Compras</h4>
                </div>
            </a>

            <a href="{{ route('person.index')}}">
                <div class="option">
                    <i class="bx bxs-user-detail" title="usuarios"></i>
                    <h4>Usuarios</h4>
                </div>
            </a>

            <a href="{{route('sales.index')}}">
                <div class="option">
                    <i class="bx bxs-business" title="ventas"></i>
                    <h4>Ventas</h4>
                </div>
            </a>

            <a href="{{route('index_informes')}}">
                <div class="option">
                    <i class="bx bxs-notepad" title="Informes"></i>
                    <h4>Informes</h4>
                </div>
            </a>
        </div>
    </div>

    <script src="js/acceso.js"></script>

    <br>

    <h2 class="titulo">Accesos Directos</h2>
    <main>
        <div class="container">
            <div class="container_0">
            <a href="agregar-producto.html">
                <div class="cuadros">
                    <div class="container_1">
                        <div class="contenido">
                        <i class='bx bx-search-alt-2' ></i>
                        <h4>Crear Producto</h4>
                        <br />
                        </div>
                    </div>
                </div>
            </a>
        <a href="Informes.html">
            <div class="cuadros">
                <div class="container_1">
                    <div class="contenido">
                        <i class="bx bxs-detail"></i>
                        <h4>Informes</h4>
                    </div>
                </div>
          </div>
        </a>
        <a href="Nueva-compra.html">
            <div class="cuadros">
                <div class="container_1">
                    <div class="contenido">
                    <i class="bx bx-cart-download"></i>
                    <h4>Registrar Compra</h4>
                    </div>
                </div>
            </div>
        </a>
        <a href="Registrar-usuario.html">
            <div class="cuadros">
                <div class="container_1">
                    <div class="contenido">
                    <i class="bx bxs-baby-carriage"></i>
                    <h4>Crear Usuario</h4>
                </div>
            </div>
            </div>
        </a>
        </div>
    </div>
    <p>
        <a href="/logout">Cerrar Sesion</a>
    </p>
    </main>
    @endauth
</body>
</html>
    {{--  Creacion de la vista cuendo la persona no esta registrada  --}}
    @guest
        @include('include.falta_sesion')
    @endguest

