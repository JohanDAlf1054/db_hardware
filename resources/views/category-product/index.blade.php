{{-- @extends('layouts.app')

@section('template_title')
    Category Product
@endsection

@section('content') --}}
{{-- @include('include.barra', ['modo'=>'Productos'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Category Product') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>Name</th>
										<th>Description</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoryProducts as $categoryProduct)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $categoryProduct->name }}</td>
											<td>{{ $categoryProduct->description }}</td>

                                            <td>
                                                <form action="{{ route('category.destroy',$categoryProduct->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('category.show',$categoryProduct->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Subcategorias') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('category.edit',$categoryProduct->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $categoryProducts->links() !!}
            </div>
        </div>
    </div> --}}
{{-- @endsection --}}
@auth
@can('category')

@include('include.barra', ['modo'=>'Categorias'])
<link rel="stylesheet" href="{{asset('css/categorias/all.css')}}">
<head>
    <link href="{{asset('css/estilos_notificacion.css')}}" rel="stylesheet"/>
    <script src="{{ asset('js/notificaciones.js')}}" defer></script>
</head>
<br>
<body>
    <div>
        @livewireStyles
        @livewire('categories-component')
        @livewireScripts
        {{-- Script  para mostrar la notificacion --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mensajeFlash = {!! json_encode(Session::get('notificacion')) !!};
                if (mensajeFlash) {
                    agregarnotificacion(mensajeFlash);
                }
            });
        </script>
        <div class="contenedor-notificacion" id="contenedor-notificacion">
        </div>
    </div>
</body>
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
