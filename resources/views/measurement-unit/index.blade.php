{{-- @extends('layouts.app')

@section('template_title')
    Unidade
@endsection

@section('content') --}}
@include('product.barra', ['modo'=>'Unidades'])
<body>
    @livewireStyles
    @livewire('units-component');
    @livewireScripts
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <x-livewire-alert::scripts />
</body>
    

