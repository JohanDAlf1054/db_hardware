@auth
    @include('include.barra', ['modo'=>'Usuarios'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                        <div class="card-body">
                            <div class="row">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    {{--  Barra de busqueda  --}}
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <form>
                                            <div class="mb-3 row">
                                                <div class="col-sm-9">
                                                    {{--  Campo para buscar el usuario  --}}
                                                    <input name="filtervalue" type="text" class="form-control" aria-label="Text input with segmented dropdown button"  placeholder="Buscar usuario....">
                                                </div>
                                                <div class="col-sm-3">
                                                    {{--  Boton para buscar  --}}
                                                    <button type="submit" class="btn btn-dark">Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container_datos">
                            {{--  Validacion para cuando se busca una informacion y no se encuentra  --}}
                            @if($usuarios->count())
                            <div class="table_container">
                                <div class="table-responsive">
                                    <table class = "table table-striped table-hover" style="justify-content: center">
                                        <thead class="table-dark">
                                            <tr style="text-align: center">
                                                <th>Nombre</th>
                                                <th>Correo electronico</th>
                                                <th>Numero de celular</th>
                                                <th>Tipo de documento</th>
                                                <th>Numero de identificacion</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $usuarios as $usuario )
                                            <tr style="text-align: center">
                                            {{--  Aqui se traen los datos guardados de los usuarios  --}}
                                                <td>{{$usuario -> name }}</td>
                                                <td>{{$usuario -> email }}</td>
                                                <td>{{$usuario -> phone_number }}</td>
                                                <td>{{$usuario -> document_type }}</td>
                                                <td>{{$usuario -> identification_number }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.usuarios.edit', $usuario->id)}}">Accesos <i class="fa-solid fa-people-line"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                                <div class="card-body">
                                    <strong>No hay registros</strong>
                                </div>
                            @endif
                        </div>
                </div>
                {{--  {!! $usuario->links() !!}  --}}
            </div>
        </div>
    </div>

@endauth
@guest
    @include('include.falta_sesion')
@endguest
