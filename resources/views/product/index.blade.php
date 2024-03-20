@auth
@include('include.barra', ['modo'=>'Productos'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-7" >
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Nuevo
                            <span class="visually-hidden">Nuevo</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('products.create') }}">Crear Producto</a></li>
                                <li><a class="dropdown-item" href="{{ route('category.index') }}">Crear Categoria</a></li>
                                <li><a class="dropdown-item" href="{{ route('brand.index') }}">Crear Marca</a></li>
                                <li><a class="dropdown-item" href="{{ route('units.index') }}"">Crear Unidad</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-9" >
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="mb-3 row">
                                    <div class="col-sm-9"> 
                                        <select name="category_filter" id="category_filter" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Filtrar por Categorias</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category_filter') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 ">
                                        <button type="submit" class=" btn btn-dark">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-9" >
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="mb-3 row" >
                                    <div class="col-lg-3 col-md-4 col-sm-9" style="display: flex">
                                        <input name="check" class="form-check-input" type="checkbox" style="padding: 0.7rem" {{ request('check') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkActivos" style="font-size: 1.1em; padding: 3%" >Activos</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class=" btn btn-dark">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-9" >
                            <form action="{{ route('products.index') }}" method="get">
                                <div class="mb-2 row">
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="table_container">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="justify-content: center">
                            <thead class="table-dark">
                                <tr style="text-align: center">
                                    <th>Categoria </th>
                                    <th>Nombre</th>
                                    <th>Referencia Fabrica</th>
                                    <th>Clasificación Tributaria</th>
                                    <th>Precio de Venta</th>
                                    <th>Marca</th>
                                    <th>Unidad de Medida</th>
                                    <th>Stock</th>
                                    <th>Foto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr style="text-align: center">
                                        <td>{{ $producto->categoryProduct->name}}</td>
                                        <td>{{ $producto->name_product }}</td>
                                        <td>{{ $producto->factory_reference }}</td>
                                        <td>{{ $producto->classification_tax }}</td>
                                        <td>{{ $producto->selling_price }}</td>
                                        <td>{{ $producto->brand->name }}</td>
                                        <td>{{ $producto->measurementUnit->name }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td><img src="{{ asset('storage/' . $producto->photo) }}" width="100" height="100">  </td>
                                        <td>
                                            @if ($producto->status == 1)
                                                <p class="badge rounded-pill bg-warning text-dark" style="font-size: 15px">Activo</p>
                                            @else
                                                <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary " href="{{ route('products.show',$producto->id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                            <a class="btn btn-sm btn-success" href="{{ route('products.edit',$producto->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                <!-- Modal de Confirmacion -->
                                            @if ($producto->status == true)
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDestroy-{{$producto->id}}"><i class="fa fa-fw fa-trash"></i></button>
                                            @else
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDestroy-{{$producto->id}}"><i class="fa-solid fa-rotate"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @include('sweetalert::alert') --}}
@include('product.modal')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endauth
@guest
    @include('include.falta_sesion')
@endguest
