@auth
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="{{ asset('vendor/laravel_backup_panel/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/laravel_backup_panel/app.css') }}" rel="stylesheet">
    <link href="css/estilos_notificacion.css" rel="stylesheet"/>
    <script src="{{ asset('js/notificaciones.js')}}" defer></script>
    @livewireStyles
</head>
@include('include.barra', ['modo'=>'Copia de Seguridad'])
@can('products')

<body>
    {{-- Script  para mostrar la notificacion --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mensajeFlash = {!! json_encode(Session::get('notificacion')) !!};
            if (mensajeFlash) {
                agregarnotificacion(mensajeFlash);
            }
        });
    </script>
    <div class="contenedor-notificacion" id="contenedor-notificacion">
    </div>
    <livewire:laravel_backup_panel::app />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @livewireScripts
</body>
</html>
@else
    <div class="mensaje_Rol">
        <img src="{{ asset('img/Rol_no_asignado.png')}}" class="img_rol"/>
        <h2 class="texto_noRol">Pídele al administrador que se te asigne un rol.</h2>
    </div>
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
