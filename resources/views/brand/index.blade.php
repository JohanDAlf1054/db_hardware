{{-- @extends('layouts.app')

@section('template_title')
    Marca
@endsection

@section('content') --}}
@include('include.barra', ['modo'=>'Marcas'])
@livewireStyles
<body>
    @livewire('brands-component');
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>
{{-- @endsection --}}
