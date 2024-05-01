@auth


    @include('include.barra', ['modo' => 'Clientes'])

    <head>
        <link href="css/estilos_vista_persona.css" rel="stylesheet" />
        <link href="css/estilos_notificacion.css" rel="stylesheet" />
        <script src="{{ asset('js/notificaciones.js') }}" defer></script>
        <script src="{{ asset('js/tooltips.js') }}" defer></script>
    </head>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                        {{ Breadcrumbs::render('customer.index') }}
                        </h3>
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
                                            <li><a class="dropdown-item" href="{{ route('person.create') }}">Craer nueva persona</a></li>
                                            <li><a class="dropdown-item" href="{{ route('supplier.index') }}">Mostrar proveedores</a></li>
                                            <li><a class="dropdown-item" href="{{ route('person.index')}}">Mostrar la tabla general</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <form action="{{ route('customer.index') }}" method="get"
                                    class="d-flex align-items-center">
                                    <input name="filtervalue" type="text" class="form-control me-2"
                                        aria-label="Buscar persona" placeholder="Buscar persona....">
                                    <button type="submit" class="btn btn-dark">Buscar</button>
                                    {{-- Botones IMPORTAR Y EXPORTAR --}}
                                    <button type="button" class="btn btn-success ms-2 rounded" data-bs-toggle="tooltip"
                                        title="Exportar" data-bs-toggle="modal" data-bs-target="#informes">
                                        <i class="fa-solid fa-file-arrow-down"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning ms-2 rounded" data-bs-toggle="tooltip"
                                        title="Importar" data-bs-toggle="modal" data-bs-target="#">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>


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
                        {{--  Aqui trae las notificaciones por medio de javascript  --}}
                    </div>

                    <div class="container_datos">
                        <div class="table_container">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="justify-content: center">
                                    <thead class="table-dark">
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
                                            <th>Nombre comercial</th>
                                            <th>Correo electronico</th>
                                            <th>Ciudad</th>
                                            <th>Direccion</th>
                                            <th>Celular</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientes as $cliente)
                                            <tr style="text-align: center">
                                                <td>{{ $cliente->rol }}</td>
                                                <td>{{ $cliente->identification_type }}</td>
                                                <td>{{ $cliente->identification_number }}</td>
                                                <td>{{ $cliente->digit_verification }}</td>
                                                {{--  <td>{{ $person->person_type }}</td>  --}}
                                                <td>{{ $cliente->company_name }}</td>
                                                <td>{{ $cliente->first_name }}</td>
                                                <td>{{ $cliente->other_name }}</td>
                                                <td>{{ $cliente->surname }}</td>
                                                <td>{{ $cliente->second_surname }}</td>
                                                <td>{{ $cliente->comercial_name }}</td>
                                                <td>{{ $cliente->email_address }}</td>
                                                <td>{{ $cliente->city }}</td>
                                                <td>{{ $cliente->address }}</td>
                                                <td>{{ $cliente->phone }}</td>
                                                <td>
                                                    @if ($cliente->status == true)
                                                        <p class="badge rounded-pill bg-warning text-dark"
                                                            style="font-size: 15px">Activo</p>
                                                    @else
                                                        <p class="badge rounded-pill bg-danger" style="font-size: 15px">
                                                            Inactivo</p>
                                                    @endif
                                                </td>
                                                <td>
                                                        <a class="btn btn-sm btn-primary " href="{{ route('customer.show',$cliente->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('customer.edit',$cliente->id) }}"><i class="fa fa-fw fa-edit"></i></a>

                                                    {{--  <!-- Button trigger modal -->  --}}

                                                    @if ($cliente->status == true)
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" data-bs-toggle="tooltip"
                                                            title="Inactivar"
                                                            data-bs-target="#confirmationDestroy-{{ $cliente->id }}"><i
                                                                class="fa fa-fw fa-trash"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" data-bs-toggle="tooltip" title="Activar"
                                                            data-bs-target="#confirmationDestroy-{{ $cliente->id }}"><i
                                                                class="fa-solid fa-rotate"></i></button>
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
            </div>
            {{--  {!! $people->links() !!}  --}}
        </div>

        @include('customer.modal')
    @endauth
    @guest
        @include('include.falta_sesion')
    @endguest
