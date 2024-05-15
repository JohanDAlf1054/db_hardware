@auth
@can('products')

@include('include.barra', ['modo'=>'Editar'])
<div class="bread_crumb">
    {{ Breadcrumbs::render('product.edit', $producto) }}
</div>
<form method="POST" action="{{ route('products.update', $producto->id) }}"  role="form" enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    @csrf

    @include('product.form')

</form>
@else
    <div class="mensaje_Rol">
        <img src="{{ asset('img/Rol_no_asignado.png')}}" class="img_rol"/>
        <h2 class="texto_noRol">Pídele al administrador que se te asigne un rol.</h2>
    </div>
@endcan

@endauth

@guest
    @include('include.falta_sesion')
@endguest
