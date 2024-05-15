@auth
@can('categorySub')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Sub Category</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('categorySub.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $subCategory->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $subCategory->description }}
                        </div>
                        <div class="form-group">
                            <strong>Category Id:</strong>
                            {{ $subCategory->category_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <div class="mensaje_Rol">
        <img src="{{ asset('img/Rol_no_asignado.png')}}" class="img_rol"/>
        <h2 class="texto_noRol">Pídele al administrador que se te asigne un rol.</h2>
    </div>
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
