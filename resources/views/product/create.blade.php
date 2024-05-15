@auth
@can('products')
@include('include.barra', ['modo'=>'Crear Producto'])
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crear Producto</title>
</head>
<body>
    <div class="bread_crumb">
        {{ Breadcrumbs::render('product.create') }}
    </div>

    <form method="POST" action="{{ route('products.store') }}"  role="form" enctype="multipart/form-data">
        @csrf
        @include('product.form')

    </form>
</body>
</html>
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
