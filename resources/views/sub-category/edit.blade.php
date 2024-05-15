@auth
@can('categorySub')
@include('include.barra', ['modo'=>'Sub Categoria'])
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <h2 id="card_title">
                            {{ __('Sub Categoría') }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categorySub.update', $subCategory->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('sub-category.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- @endsection --}}
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
