@auth
    
@include('include.barra', ['modo'=>'Crear Compra Proveedor'])

    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Purchase Supplier</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('purchase_supplier.update', $purchaseSupplier->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('purchase-supplier.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endauth