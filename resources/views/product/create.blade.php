{{-- @extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Producto
@endsection

@section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Producto</title>
    <link rel="stylesheet" href="{{ asset('css/estilos_agregar_producto.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/estilosbarra.css') }}" type="text/css">
</head>
<body>
    {{-- <section class="content container-fluid">
        <div class="row"> --}}
            {{-- <div class="col-md-12"> --}}
{{-- 
                @includeif('partials.errors') --}}
                {{-- <div class="card card-default"> --}}
                    {{-- <div class="card-body"> --}}
                        <form method="POST" action="{{ route('products.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('product.form', ['modo'=>'Crear Producto'])

                        </form>
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </div>
    </section> --}}
</body>
</html>

{{-- @endsection --}}
