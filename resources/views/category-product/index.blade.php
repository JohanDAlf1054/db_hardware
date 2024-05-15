@auth
@can('category')

@include('include.barra', ['modo'=>'Categorias'])
<link rel="stylesheet" href="{{asset('css/categorias/all.css')}}">
<head>
    <link href="{{asset('css/estilos_notificacion.css')}}" rel="stylesheet"/>
    <script src="{{ asset('js/notificaciones.js')}}" defer></script>
    <script src="{{ asset('js/tooltips.js') }}" defer></script>
</head>
<br>
<body>
    <div>
        @livewireStyles
        @livewire('categories-component')
        @livewireScripts
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
    </div>
</body>
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
