{{--  @extends('layouts.app')

@section('template_title')
    Person
@endsection

@section('content')  --}}
@auth


@include('include.barra', ['modo'=>'Personas'])

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
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Nuevo
                                        <span class="visually-hidden">Nuevo</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('person.create') }}">Craer nueva persona</a></li>
                                        <li><a class="dropdown-item" >Motrar proveedores</a></li>
                                        <li><a class="dropdown-item" >Mostrar clientes</a></li>
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


                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
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
                                        @foreach ($people as $person)
                                            <tr style="text-align: center">
                                                <td>{{ $person->rol }}</td>
                                                <td>{{ $person->identification_type }}</td>
                                                <td>{{ $person->identification_number }}</td>
                                                <td>{{ $person->digit_verification }}</td>
                                                {{--  <td>{{ $person->person_type }}</td>  --}}
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
                                                        <a class="btn btn-sm btn-success" href="{{ route('person.edit',$person->id) }}"><i class="fa fa-fw fa-edit"></i></a>

                                                        {{--  <!-- Button trigger modal -->  --}}

                                                        @if ($person->status == true)
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDestroy-{{$person->id}}"><i class="fa fa-fw fa-trash"></i></button>
                                                        @else
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDestroy-{{$person->id}}"><i class="fa-solid fa-rotate"></i></button>
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
