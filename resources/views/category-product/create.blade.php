{{-- @extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Category Product
@endsection

@section('content') --}}
@include('product.barra', ['modo'=>'Crear Categoria'] )
    <section class=" container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card card-default">
                        <div class="card-body">
                            <form method="POST" action="{{ route('category.store') }}"  role="form">
                                @csrf

                                @include('category-product.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
{{-- @endsection --}}
