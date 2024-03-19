{{-- @extends('layouts.app')

@section('template_title')
    Unidade
@endsection

@section('content') --}}
@auth


@include('include.barra', ['modo'=>'Unidades de Medida'])
<body>
    @livewireStyles
    @livewire('units-component');
    @livewireScripts
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <x-livewire-alert::scripts />
</body>
@endauth
@guest
    @include('include.falta_sesion')
@endguest

