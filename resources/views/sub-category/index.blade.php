{{-- @extends('layouts.app')

@section('template_title')
    Marca
@endsection

@section('content') --}}
@auth

@include('include.barra', ['modo'=>'Sub Categoria'])
@livewireStyles
<body>
    @livewire('sub-category-component')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>
{{-- @endsection --}}
@endauth
@guest
    @include('include.falta_sesion')
@endguest
