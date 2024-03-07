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
</body>
    

