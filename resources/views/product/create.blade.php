
@auth


@include('include.barra', ['modo'=>'Crear Producto'])
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crear Producto</title>
</head>
<body>
    <form method="POST" action="{{ route('products.store') }}"  role="form" enctype="multipart/form-data">
        @csrf
        @include('product.form')
    </form>
</body>
</html>
@endauth
@guest
    @include('include.barra')
@endguest
