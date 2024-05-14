@auth
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
@endauth
@guest
    @include('include.falta_sesion')
@endguest
