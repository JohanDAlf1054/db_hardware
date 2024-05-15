@auth
@include('include.barra', ['modo'=>'Detalle de Compra'])
@can('detail-purchases')

@section('content')

    <form method="POST" action="{{ route('detail-purchases.update', $detailPurchase->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('detail-purchase.form')

    </form>
@endcan
@endauth
