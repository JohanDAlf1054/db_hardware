{{--  @extends('layouts.app')

@section('template_title')
    Person
@endsection

@section('content')  --}}
@auth


@include('include.barra', ['modo'=>'Personas'])
<head>
    <title>Personas</title>
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
                                <div class="col-lg-6 col-md-6 col-sm-12 " >
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Acciones
                                        <span class="visually-hidden">Acciones</span>
                                    </button>
                                        <ul class="dropdown-menu desplegable_acciones">
                                            <div class="acciones_boton">
                                                <li><a class="dropdown-item" href="{{ route('person.create') }}">Crear nueva persona</a></li>
                                                <li><a class="dropdown-item" href="{{ route('supplier.index') }}">Mostrar proveedores</a></li>
                                                <li><a class="dropdown-item" href="{{ route('customer.index')}}">Mostrar clientes</a></li>
                                            </div>
                                        </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                    <form action="{{ route('person.index') }}" method="get">
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
                            {{--  <div class="notificacion exito" id="1">
                                <div class="contenido">
                                    <div class="icono">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                                        </svg>
                                    </div>
                                    <div class="texto">
                                        <p class="titulo">Registro Exito!</p>
                                        <p class="descripcion">Se ha agregado el tercero.</p>
                                    </div>
                                </div>
                                <button class="boton-cerrar">
                                    <div class="icono">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <div class="notificacion error" id="2">
                                <div class="contenido">
                                    <div class="icono">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 16 16">
                                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                        </svg>
                                    </div>
                                    <div class="texto">
                                        <p class="titulo">Atencion!</p>
                                        <p class="descripcion">Se ha inactivado la persona</p>
                                    </div>
                                </div>
                                <button class="boton-cerrar">
                                    <div class="icono">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                    </div>
                                </button>
                            </div>  --}}
                        </div>

                    <div class="container_datos">
                        <div class="table_container">

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="justify-content: center">
                                    <thead class="table-dark" >
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
                                                <td>{{ $person->email_address }}</td>
                                                <td>{{ $person->city }}</td>
                                                <td>{{ $person->address }}</td>
                                                <td>{{ $person->phone }}</td>
                                                <td>
                                                    @if($person->status == True)
                                                    <p class="badge rounded-pill bg-warning text-dark" style="font-size: 15px">Activo</p>
                                                    @else
                                                    <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                                                    @endif
                                                </td>

                                                <td>
                                                        <a class="btn btn-sm btn-primary " href="{{ route('person.show',$person->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                        {{--  Se suspendieron las acciones de borrar y editar en la vista general de la tabla  --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {!! $people->links() !!}
            </div>
        </div>
    </div>
@include('person.modal')
@endauth
@guest
    @include('include.falta_sesion')
@endguest
{{--  @endsection  --}}
