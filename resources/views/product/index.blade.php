{{-- @extends('layouts.app')

@section('template_title')
    Producto
@endsection --}}

{{-- @section('content') --}}
    @include('product.barra', ['modo'=>'Productos'])
    {{-- <link rel="stylesheet" href="{{ asset('css/index/index.css') }}"> --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body" >
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Nuevo
                                    <span class="visually-hidden">Nuevo</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('products.create') }}">Crear Producto</a></li>
                                        <li><a class="dropdown-item" href="{{ route('category.index') }}">Crear Categoria</a></li>
                                        <li><a class="dropdown-item" href="{{ route('categorySub.index') }}">Crear Sub Categoria</a></li>
                                        <li><a class="dropdown-item" href="{{ route('brand.index') }}">Crear Marca</a></li>
                                        <li><a class="dropdown-item" href="{{ route('units.index') }}"">Crear Unidad</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                    <form action="{{ route('products.index') }}" method="get">
                                        <div class="mb-3 row">
                                            <div class="col-sm-9">
                                                <input name="filtervalue" type="text" class="form-control" aria-label="Text input with segmented dropdown button"  placeholder="Buscar Producto....">
                                            </div>
                                            <div class=" col-sm-3">
                                                <button type="submit" class=" btn btn-dark">Buscar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              </div>
                        </div>

                        <div class="container_datos">
                            <div class="table_container">
                                <div class="table-responsive">
                                <table class="table table-striped table-hover" style="justify-content: center">
                                    <thead class="table-dark">
                                        <tr style="text-align: center">
                                            <th>Categoria </th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Referencia Fabrica</th>
                                            <th>Clasificación Tributaria</th>
                                            <th>Unidades</th>
                                            <th>Stock</th>
                                            <th>Foto</th>
                                            <th>Estado</th>
                                            <th>Marca</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr style="text-align: center">
                                                <td style="margin-top: 10px">{{ $producto->categoryProduct->name}}</td>
                                                <td>{{ $producto->name_product }}</td>
                                                <td>{{ $producto->description_long }}</td>
                                                <td>{{ $producto->factory_reference }}</td>
                                                <td>{{ $producto->classification_tax }}</td>
                                                <td>{{ $producto->measurementUnit->name }}</td>
                                                <td>{{ $producto->stock }}</td>
                                                <td><img src="{{ asset('storage/' . $producto->photo) }}" width="200" height="200"> </td>
                                                <td>{{ $producto->status }}</td>
                                                <td>{{ $producto->brand->name }}</td>
                                                <td>
                                                    <form action="{{ route('products.destroy',$producto->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary " href="{{ route('products.show',$producto->id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('products.edit',$producto->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                    {!! $productos->links() !!}
                </div>
            </div>
        </div>

{{-- @endsection --}}
