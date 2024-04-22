{{-- @extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Sub Category
@endsection

@section('content') --}}
@include('include.barra', ['modo'=>'Crear Sub Categoria']) 
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <h2 id="card_title">
                            {{ __('Sub Categoría') }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categorySub.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('sub-category.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- @endsection --}}
