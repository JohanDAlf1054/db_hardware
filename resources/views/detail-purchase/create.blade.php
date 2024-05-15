@auth
@can('detail-purchases')

@include('include.barra', ['modo'=>'Crear Detalle de Compra'])

<div class="bread_crumb">
    {{ Breadcrumbs::render('detail.purchase.create') }}
</div>

    <form method="POST" action="{{ route('detail-purchases.store') }}"  role="form" enctype="multipart/form-data">
        @csrf

        @include('detail-purchase.form')

    </form>
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
