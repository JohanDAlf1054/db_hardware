{{-- @extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Category Product
@endsection

@section('content') --}}
@include('include.barra', ['modo'=>'Productos'])
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    {{-- <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Category Product</span>
                    </div> --}}
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('category-product.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- @endsection --}}
