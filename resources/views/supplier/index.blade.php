@auth


    @include('include.barra', ['modo' => 'Ferreteria la excelencia'])

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
                            {{ Breadcrumbs::render('supplier.index') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                {{-- Desplegable de opciones --}}
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('person.create') }}">Crear nueva
                                                persona</a></li>
                                        <li><a class="dropdown-item" href="{{ route('person.index') }}">Mostrar tabla
                                                general</a></li>
                                        <li><a class="dropdown-item" href="{{ route('customer.index') }}">Mostrar
                                                clientes</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <form action="{{ route('supplier.index') }}" method="get"
                                    class="d-flex align-items-center">
                                    <input name="filtervalue" type="text" class="form-control me-2"
                                        aria-label="Buscar persona" placeholder="Buscar persona....">
                                    <button type="submit" class="btn btn-dark">Buscar</button>
                                    {{-- Botones IMPORTAR Y EXPORTAR --}}
                                    <button type="button" class="btn btn-success ms-2 rounded" tooltip="tooltip"
                                        title="Exportar" data-bs-toggle="modal" data-bs-target="#informes">
                                        <i class="fa-solid fa-file-arrow-down"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning ms-2 rounded" tootltip="tooltip" 
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
                        <div class="table_container p-3">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="justify-content: center">
                                    <thead class="table-dark">
                                        <tr style="text-align: center">
                                            <th>Tercero</th>
                                            <th>Tipo ID</th>
                                            <th>Identificación</th>
                                            <th>DV</th>
                                            {{--  <th>Tipo de persona</th>  --}}
                                            <th>Razón social</th>
                                            <th>Primer nombre</th>
                                            <th>Otro nombre</th>
                                            <th>Apellido</th>
                                            <th>Segundo apellido</th>
                                            <th>Nombre comercial</th>
                                            <th>Correo electrónico</th>
                                            <th>Ciudad</th>
                                            <th>Dirección</th>
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
                                                <td>{{ $proveedor->comercial_name }}</td>
                                                <td>{{ $proveedor->email_address }}</td>
                                                <td>{{ $proveedor->city }}</td>
                                                <td>{{ $proveedor->address }}</td>
                                                <td>{{ $proveedor->phone }}</td>
                                                <td>
                                                    @if ($proveedor->status == true)
                                                        <p class="badge rounded-pill bg-success text-dark"
                                                            style="font-size: 15px">Activo</p>
                                                    @else
                                                        <p class="badge rounded-pill bg-danger" style="font-size: 15px">
                                                            Inactivo</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" tooltip="tooltip"
                                                        title="Visualizar"
                                                        href="{{ route('person.show', $proveedor->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" tooltip="tooltip"
                                                        title="Modificar"
                                                        href="{{ route('person.edit', $proveedor->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>

                                                    {{--  <!-- Button trigger modal -->  --}}

                                                    @if ($proveedor->status == true)
                                                        <button type="button" class="btn btn-danger btn-sm" 
                                                            data-bs-toggle="modal" tooltip="tooltip"
                                                            title="Inactivar"
                                                            data-bs-target="#confirmationDestroy-{{ $proveedor->id }}"><i
                                                                class="fa fa-fw fa-trash"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" tooltip="tooltip" title="Activar"
                                                            data-bs-target="#confirmationDestroy-{{ $proveedor->id }}"><i
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


        @include('supplier.modal')
    @endauth
    @guest
        @include('include.falta_sesion')
    @endguest
