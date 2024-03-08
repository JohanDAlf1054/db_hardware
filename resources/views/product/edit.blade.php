@auth


@include('include.barra', ['modo'=>'Editar'])

<form method="POST" action="{{ route('products.update', $producto->id) }}"  role="form" enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    @csrf

    @include('product.form')
</form>
@endauth
@guest
    @include('include.falta_sesion')
@endguest

