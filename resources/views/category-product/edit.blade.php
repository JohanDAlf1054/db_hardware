@auth
@can('category')

    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Category Product</span>
                    </div>
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
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
