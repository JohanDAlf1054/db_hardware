{{-- @extends('layouts.app')

@section('template_title')
    Marca
@endsection

@section('content') --}}
@include('product.barra', ['modo'=>'Sub Categoria'])
@livewireStyles
<body>
    @livewire('sub-category-component')
    @livewireScripts
</body>
{{-- @endsection --}}