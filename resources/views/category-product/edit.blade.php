{{-- @extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Category Product
@endsection

@section('content') --}}
@include('product.barra', ['modo'=>'Editar Categoria'] )
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.update', $categoryProduct->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('category-product.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- @endsection --}}
