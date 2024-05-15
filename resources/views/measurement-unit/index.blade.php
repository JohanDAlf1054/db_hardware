@auth
@can('units')

@include('include.barra', ['modo'=>'Unidades de Medida'])
<head>
    <link href="{{asset('css/estilos_notificacion.css')}}" rel="stylesheet"/>
    <script src="{{ asset('js/notificaciones.js')}}" defer></script>
    <script src="{{ asset('js/tooltips.js') }}" defer></script>
</head>
<br>
<body>
    @livewireStyles
    @livewire('units-component');
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
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
