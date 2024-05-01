@auth
@include('include.barra', ['modo'=>'Marcas'])
<head>
    <link href="{{asset('css/estilos_notificacion.css')}}" rel="stylesheet"/>
    <script src="{{ asset('js/notificaciones.js')}}" defer></script>
</head>
<br>
@livewireStyles
<body>
    @livewire('brands-component')
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
</body>
@endauth
@guest
    @include('include.falta_sesion')
@endguest
