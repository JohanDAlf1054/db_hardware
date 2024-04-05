@auth
    @include('include.barra', ['modo'=>'Permiso de usuarios'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="container_datos">
                        <div class="card">
                            @if(session('info'))
                                <div class="alert alert-success">
                                    <strong>{{session('info')}}</strong>
                                </div>
                            @endif
                            <div class="card-body">
                                Asiganr un rol
                                <p class="h5">Nombre:</p>
                                <p class="form-control">{{$usuario->name}}</p>
                                <h2 class="h5"> Listado de roles</h2>
                                {!! Form::model($usuario, ['route' => ['admin.usuarios.update', $usuario->id], 'method' => 'put']) !!}
                                    @foreach ($roles as $role )
                                        <div>
                                            <label>
                                                {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach

                                    {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endauth
@guest
    @include('include.falta_sesion')
@endguest
