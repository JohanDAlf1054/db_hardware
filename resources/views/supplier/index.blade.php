@auth


@include('include.barra', ['modo'=>'Proveedores'])
<head>
    <link href="css/estilos_vista_persona.css" rel="stylesheet" />
    <link href="css/estilos_notificacion.css" rel="stylesheet"/>
    <script src="{{ asset('js/notificaciones.js')}}" defer></script>
</head>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                {{--  Desplegable de opciones  --}}
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Acciones
                                        <span class="visually-hidden">Acciones</span>
                                    </button>
                                    <ul class="dropdown-menu desplegable_acciones">
                                        <div class="acciones_boton">
                                            <li><a class="dropdown-item" href="{{ route('person.create') }}">Crear nueva persona</a></li>
                                            <li><a class="dropdown-item" href="{{ route('person.index') }}" >Motrar tabla general</a></li>
                                            <li><a class="dropdown-item" href="{{ route('customer.index')}}">Mostrar clientes</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                    <form action="{{ route('supplier.index') }}" method="get">
                                        <div class="mb-3 row">
                                            <div class="col-sm-9">
                                                <input name="filtervalue" type="text" class="form-control" aria-label="Text input with segmented dropdown button"  placeholder="Buscar persona....">
                                            </div>
                                            <div class=" col-sm-3">
                                                <button type="submit" class=" btn btn-dark">Buscar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Script  para mostrar la notificacion --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
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

                    <div class="container_datos">
                        <div class="table_container">

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="justify-content: center">
                                    <thead class="table-dark" >
                                        <tr style="text-align: center">
                                            <th>Tercero</th>
                                            <th>Tipo ID</th>
                                            <th>Identificacion</th>
                                            <th>DV</th>
                                            {{--  <th>Tipo de persona</th>  --}}
                                            <th>Razon social</th>
                                            <th>Primer nombre</th>
                                            <th>Otro nombre</th>
                                            <th>Apellido</th>
                                            <th>Segundo apellido</th>
                                            <th>Correo electronico</th>
                                            <th>Ciudad</th>
                                            <th>Direccion</th>
                                            <th>Celular</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proveedores as $proveedor)
                                            <tr style="text-align: center">
                                                <td>{{ $proveedor->rol }}</td>
                                                <td>{{ $proveedor->identification_type }}</td>
                                                <td>{{ $proveedor->identification_number }}</td>
                                                <td>{{ $proveedor->digit_verification }}</td>
                                                {{--  <td>{{ $person->person_type }}</td>  --}}
                                                <td>{{ $proveedor->company_name }}</td>
                                                <td>{{ $proveedor->first_name }}</td>
                                                <td>{{ $proveedor->other_name }}</td>
                                                <td>{{ $proveedor->surname }}</td>
                                                <td>{{ $proveedor->second_surname }}</td>
                                                <td>{{ $proveedor->email_address }}</td>
                                                <td>{{ $proveedor->city }}</td>
                                                <td>{{ $proveedor->address }}</td>
                                                <td>{{ $proveedor->phone }}</td>
                                                <td>
                                                    @if($proveedor->status == True)
                                                    <p class="badge rounded-pill bg-success text-dark" style="font-size: 15px">Activo</p>
                                                    @else
                                                    <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                                                    @endif
                                                </td>

                                                <td>
                                                        <a class="btn btn-sm btn-primary " href="{{ route('person.show',$proveedor->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('person.edit',$proveedor->id) }}"><i class="fa fa-fw fa-edit"></i></a>

                                                        {{--  <!-- Button trigger modal -->  --}}

                                                        @if ($proveedor->status == true)
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDestroy-{{$proveedor->id}}"><i class="fa fa-fw fa-trash"></i></button>
                                                        @else
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDestroy-{{$proveedor->id}}"><i class="fa-solid fa-rotate"></i></button>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  {!! $people->links() !!}  --}}
            </div>
        </div>
    </div>
@include('supplier.modal')
@endauth
@guest
    @include('include.falta_sesion')
@endguest
