@auth
    @include('include.barra', ['modo' => 'Editar información '])
    {{--  @can('profile')  --}}
    <div class="bread_crumb">
        {{ Breadcrumbs::render('profile.edit') }}
    </div>
    <br>
    <div class="content container-fluid">
        <div class="page-body">
            <div class="container-x1">
                <div class="row row-cards">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Datos de usuario
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('profile.update')}}" method="POST">
                                        @csrf
                                        <div class="row row-cards">
                                            {{--  Nombre del usuario  --}}
                                            <div class="col-sm-6 md-6">
                                                <div class="md-3"  style="margin-bottom: 16px">
                                                    <label for="name" class="form-label" style="font-weight: bolder">
                                                        Nombre de usuario:
                                                    </label>
                                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                                                </div>
                                            </div>
                                            {{--  Correo electronico  --}}
                                            <div class="col-sm-6 md-6">
                                                <div class="md-3"  style="margin-bottom: 16px">
                                                    <label for="email" class="form-label" style="font-weight: bolder">
                                                        Correo electrónico:
                                                    </label>
                                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                                                </div>
                                            </div>
                                            {{--  Numero de celular  --}}
                                            <div class="col-sm-6 md-6">
                                                <div class="md-3"  style="margin-bottom: 16px">
                                                    <label for="phone_number" class="form-label" style="font-weight: bolder">
                                                        Numero de celular:
                                                    </label>
                                                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="form-control">
                                                </div>
                                            </div>
                                            {{--  Tipo de documento  --}}
                                            <div class="col-sm-6 md-6">
                                                <div class="md-3"  style="margin-bottom: 16px">
                                                    <label for="document_type" class="form-label" style="font-weight: bolder">
                                                        Tipo de identificación :
                                                    </label>
                                                    <select name="document_type" id="tipo_documento" class="form-select">
                                                        <option value="CC" {{ $user->document_type == 'CC' ? 'selected' : ''}}>C.C - Cédula de ciudadanía</option>
                                                        <option value="TI" {{ $user->document_type == 'TI' ? 'selected' : ''}}>T.I - Tarjeta de identidad</option>
                                                        <option value="RC" {{ $user->document_type == 'RC' ? 'selected' : ''}}>R.C - Registro civil</option>
                                                        <option value="TE" {{ $user->document_type == 'TE' ? 'selected' : ''}}>T.E - Tarjeta de extaranjeria</option>
                                                        <option value="CE" {{ $user->document_type == 'CE' ? 'selected' : ''}}>C.E - Cedula de extranjeria</option>
                                                        <option value="NIT" {{ $user->document_type == 'NIT' ? 'selected' : ''}}>NIT - Numero de identificacion tributaria</option>
                                                        <option value="PP" {{ $user->document_type == 'PP' ? 'selected' : ''}}>P.P - Pasaporte</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{--  Numero deidentificacion  --}}
                                            <div class="col-sm-6 md-6">
                                                <div class="md-3"  style="margin-bottom: 16px">
                                                    <label for="identification_number" class="form-label" style="font-weight: bolder">
                                                        Número de identificación:
                                                    </label>
                                                    <input type="text" id="identification_number" name="identification_number" value="{{ old('identification_number', $user->identification_number) }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer text-end">
                                    <a class="btn btn-primary" href="{{ route('profile.index') }}">Regresar</a>
                                    <button type="submit" class="btn btn-success">{{ __('Actualizar') }}</button>
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
