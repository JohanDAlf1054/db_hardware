@auth
    @include('include.barra', ['modo' => 'Cambiar contraseña'])
    {{--  @can('profile')  --}}
    <div class="bread_crumb">
        {{ Breadcrumbs::render('profile.password') }}
    </div>
    <br>
    {{-- Script  para mostrar la notificacion --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mensajeFlash = {!! json_encode(Session::get('notificacion')) !!};
            if (mensajeFlash) {
                agregarnotificacion(mensajeFlash);
            }
        });
    </script>

    {{--  Div con las notificaciones nuevas  --}}
    <div class="contenedor-notificacion" id="contenedor-notificacion">
        {{--  Aqui trae las notificaciones por medio de javaescript  --}}
    </div>
    <div class="content container-fluid">
        <div class="page-body">
            <div class="container-x1">
                <div class="row row-cards">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Cambiar contraseña
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('password.update')}}" method="POST">
                                        @csrf
                                        {{--  Contraseña actual  --}}
                                        <div class="row row-cards">
                                            <div class="col-sm-6 md-6">
                                                <div class="md-3" style="margin-bottom: 16px">
                                                    <label for="current_password" class="form-label" style="font-weight: bolder">
                                                        Contraseña actual:
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="password" id="current_password" name="current_password" required class="form-control">
                                                    @error('current_password')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{--  Nueva contraseña  --}}
                                        <div class="row row-cards">
                                            <div class="col-sm-6 md-6">
                                                <div class="md-3" style="margin-bottom: 16px">
                                                    <label for="new_password" class="form-label" style="font-weight: bolder">
                                                        Nueva contraseña:
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="password" id="new_password" name="new_password" required class="form-control">
                                                    @error('new_password')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{--  Confirmar contraseña  --}}
                                        <div class="row row-cards">
                                            <div class="col-sm-6 md-6">
                                                <div class="md-3" style="margin-bottom: 16px">
                                                    <label for="new_password_confirmation" class="form-label" style="font-weight: bolder">
                                                        Confirmar nueva contraseña:
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required class="form-control">
                                                    @error('new_password_confirmation')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer text-end">
                                    <a class="btn btn-primary" href="{{ route('profile.index') }}">Regresar</a>
                                    <button type="submit" class="btn btn-success">{{ __('Cambiar contraseña') }}</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{--  @else
        <div class="mensaje_Rol">
            <img src="{{ asset('img/Rol_no_asignado.png') }}" class="img_rol" />
            <h2 class="texto_noRol">Pídele al administrador que se te asigne un rol.</h2>
        </div>
    @endcan  --}}
@endauth
@guest
    @include('include.falta_sesion')
@endguest
