@auth


    @include('include.barra', ['modo' => 'Personas'])

    <head>
        <title>Personas</title>
        <link href="css/estilos_vista_persona.css" rel="stylesheet" />
        <link href="css/estilos_notificacion.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
        <script src="{{ asset('js/notificaciones.js') }}" defer></script>
        <script src="{{ asset('js/tooltips.js') }}" defer></script>
        <script src="{{ asset('js/datatable.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>

    </head>
    <br>
    @can('person')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ Breadcrumbs::render('person.index') }}
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
                                        <li><a class="dropdown-item" href="{{ route('supplier.index') }}">Mostrar
                                                proveedores</a></li>
                                        <li><a class="dropdown-item" href="{{ route('customer.index') }}">Mostrar
                                                clientes</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <form action="{{ route('person.index') }}" method="get" class="d-flex align-items-center">
                                    <input name="filtervalue" type="text" class="form-control me-2"
                                        aria-label="Buscar persona" placeholder="Buscar persona....">
                                    <button type="submit" class="btn btn-dark">Buscar</button>

                                    {{-- Botones IMPORTAR Y EXPORTAR --}}

                                    <button type="button" class="btn btn-success ms-2 rounded" data-bs-toggle="tooltip"
                                        title="Exportar" onclick="window.location.href='{{ route('export.person') }}'">
                                        <i class="fa-solid fa-file-arrow-down"></i>
                                    </button>

                                    <button type="button" class="btn btn-warning ms-2 rounded" tooltip="tooltip"
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
                        {{--  Aqui trae las notificaciones por medio de javaescript  --}}
                    </div>

                    <div class="container_datos p-3">
                        <div class="table_container">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="datatable"
                                    style="justify-content:center">
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
                                        @foreach ($people as $person)
                                            <tr style="text-align: center">
                                                <td>{{ $person->rol }}</td>
                                                <td>{{ $person->identification_type }}</td>
                                                <td>{{ $person->identification_number }}</td>
                                                <td>{{ $person->digit_verification }}</td>
                                                <td>{{ $person->company_name }}</td>
                                                <td>{{ $person->first_name }}</td>
                                                <td>{{ $person->other_name }}</td>
                                                <td>{{ $person->surname }}</td>
                                                <td>{{ $person->second_surname }}</td>
                                                <td>{{ $person->comercial_name }}</td>
                                                <td>{{ $person->email_address }}</td>
                                                <td>{{ $person->city }}</td>
                                                <td>{{ $person->address }}</td>
                                                <td>{{ $person->phone }}</td>
                                                <td>
                                                    @if ($person->status == true)
                                                        <p class="badge rounded-pill bg-success text-dark"
                                                            style="font-size: 15px">Activo</p>
                                                    @else
                                                        <p class="badge rounded-pill bg-danger" style="font-size: 15px">
                                                            Inactivo
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" tooltip="tooltip" title="Visualizar"
                                                        href="{{ route('person.show', $person->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
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
            {!! $people->links() !!}
        </div>
    </div>
    </div>
    @endcan
    @include('person.modal')
@endauth
@guest
    @include('include.falta_sesion')
@endguest
{{--  @endsection  --}}
