{{-- @extends('layouts.app')

@section('template_title')
    Sub Category
@endsection

@section('content') --}}
@auth
@include('include.barra', ['modo'=>'Sub Categorias'])
<head>
    <link href="{{asset('css/estilos_notificacion.css')}}" rel="stylesheet"/>
    <script src="{{ asset('js/notificaciones.js')}}" defer></script>
</head>
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-10-sm">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; justify-content: space-between">
                            <button type="button" class="btn btn-light">
                                <a href="{{route('category.index')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                                </a>
                            </button>
                            @if (count($subCategories) > 0)
                                <h2>Sub Categorías de {{ $subCategories[0]->categoryProduct->name }}</h2>
                            @endif

                            <span  class="card-title">
                                <a href="{{ route('categorySub.create') }}" type="button" class="btn btn-primary mx-2 float-right " >
                                    Crear Sub Categoria
                                </a>
                            </span>
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
                    <div class="contenedor-notificacion" id="contenedor-notificacion">
                    </div>
                    <div class="table_container">
                        <div class="table-responsive">
                            <table  class="table table-striped  style="justify-content: center">
                                <thead class="table-dark">
                                    <tr>
										<th>Nombre de la Sub Categoria</th>
										<th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subCategories as $subCategory)
                                        <tr>
                                            
											<td>{{ $subCategory->name }}</td>
											<td>{{ $subCategory->description }}</td>
                                            <td>
                                                <form action="{{ route('categorySub.destroy',$subCategory->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('categorySub.edit',$subCategory->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $subCategories->links() }}
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