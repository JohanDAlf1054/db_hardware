{{-- @extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Producto
@endsection

@section('content') --}}
    {{-- <section class="content container-fluid"> --}}
        {{-- <div class=""> --}}
            {{-- <div class="col-md-12"> --}}

                @includeif('partials.errors')

                
                    {{-- <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Producto</span>
                    </div> --}}
                    
                        <form method="POST" action="{{ route('products.update', $producto->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('product.form', ['modo'=>'Editar'])

                        </form>
                    
                
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </section> --}}
{{-- @endsection --}}
