@guest
@include('include.barra', ['modo'=>'Personas'])
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ToryTech</title>
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
                <a href="#">
                    <div class="option">
                        <i class='bx bxs-home' ></i>
                        <h4>Inicio</h4>
                    </div>
                </a>

                <a href="#">
                    <div class="option">
                    <i class="bx bxs-package" title="Productos"></i>
                    <h4>Productos</a></h4>
                    </div>
                </a>

                <a href="#">
                    <div class="option">
                    <i class="bx bxs-dollar-circle" title="compras"></i>
                    <h4>Compras</h4>
                    </div>
                </a>

                <a href="#">
                    <div class="option">
                    <i class="bx bxs-user-detail" title="usuarios"></i>
                    <h4>Usuarios</h4>
                    </div>
                </a>

                <a href="#">
                    <div class="option">
                    <i class="bx bxs-business" title="ventas"></i>
                    <h4>Ventas</h4>
                </div>
                </a>

                <a href="#">
                    <div class="option">
                    <i class="bx bxs-notepad" title="Informes"></i>
                    <h4>Informes</h4>
                </div>
                </a>
            </div>
        </div>

        <script src="{{ asset('js/acceso.js')}}"></script>

        <br>
            <div class="div-endguest">
                Para ver el contenido de la aplicacion, <a href="/login"><b>Inicia sesión</b></a>
            </div>

    @endguest

    </body>
    </html>
