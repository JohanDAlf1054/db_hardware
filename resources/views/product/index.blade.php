@auth

@include('include.barra', ['modo'=>'Productos'])
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12" >
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
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="col-sm-9">
                                    <input name="check" class="form-check-input" type="checkbox">Filtrar Activos
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </form>
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="form-group">
                                    <label for="category_filter">Filtrar por categoría:</label>
                                    <select name="category_filter" id="category_filter" class="form-control">
                                        <option value="">Todas las categorías</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category_filter') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </form>
                        </div>
                    </div>
                </div>
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
                                    <th>Unidad</th>
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
                                        <td><img src="{{ asset('storage/' . $producto->photo) }}" width="150" height="150">  </td>
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
                                                <!-- Button trigger modal -->
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
@endauth
@guest
    @include('include.falta_sesion')
@endguest
