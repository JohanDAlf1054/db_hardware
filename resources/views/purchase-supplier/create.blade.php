@auth

@include('include.barra', ['modo'=>'Crear Compra Proveedor'])
@can('purchase_supplier')

<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')


                <div class="card card-default">
                   <div class="card-header">
                        {{-- <span class="card-title">{{ __('Create') }} Purchase Supplier</span> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('purchase_supplier.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            @include('purchase-supplier.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
