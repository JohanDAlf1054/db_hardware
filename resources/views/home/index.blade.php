@auth
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home</title>
        <link rel="stylesheet" href="css/accesos_directos.css" />
        <link rel="stylesheet" href="{{ asset('css/estilosbarra.css') }}" type="text/css">
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
            <div class="cerrar_sesion">
                <a href="/logout">
                    Cerrar sesion
                    <i class="fa-solid fa-door-open"></i>
                </a>
                <p>Texto publico</p>
                
            </div>
        </header>

        <div class="menu__side" id="menu_side">
                <div class="name__page">
                    <i><img class="logos" src="./img/Logo.png" alt="" /></i>
                </div>

                <div class="options__menu">
                    <a href="/home" class="selected">
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
        <div class="contenedor-toast" id="contenedor-toast">
            {{--  Aqui trae las notificaciones por medio de javaescript  --}}
            {{--  <div class="toast exito" id="1">
                <div class="contenido">
                    <div class="icono">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                        </svg>
                    </div>
                    <div class="texto">
                        <p class="titulo">Exito!</p>
                        <p class="descripcion">Se ha agregado el tercero.</p>
                    </div>
                </div>
                <button class="btn-cerrar">
                    <div class="icono">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                </button>
            </div>  --}}
            {{--  <div class="toast error" id="2">
                <div class="contenido">
                    <div class="icono">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 16 16">
                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                    </div>
                    <div class="texto">
                        <p class="titulo">Atencion!</p>
                        <p class="descripcion">Se ha inactivado la persona</p>
                    </div>
                </div>
                <button class="btn-cerrar">
                    <div class="icono">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                </button>
            </div>  --}}
        </div>
        <h2 class="titulo">Accesos Directos</h2>
        <main>
            <div class="container">
                <div class="container_0">
                    <a href="{{route('products.index')}}">
                        <div class="cuadros">
                            <div class="container_1">
                                <div class="contenido">
                                <i class='bx bx-search-alt-2'></i>
                                    <h4>Crear Producto</h4>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{route('index_informes')}}">
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
                    <a href="{{ route('person.index')}}">
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
        </main>
@endauth

        {{--  Creacion de la vista cuendo la persona no esta registrada  --}}
        @guest
            @include('include.falta_sesion')
        @endguest

</body>
</html>
