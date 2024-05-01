
@include('include.barra', ['modo'=>'Editar'])
<div class="bread_crumb">
    {{ Breadcrumbs::render('product.edit', $producto) }}
</div>
<form method="POST" action="{{ route('products.update', $producto->id) }}"  role="form" enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    @csrf

    @include('product.form')

</form>

