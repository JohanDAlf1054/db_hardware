@auth
@include('include.barra', ['modo' => 'Informe Productos'])
<br>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
</head>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-header" style="display: flex">
                    {{-- <div class="row"> --}}
                        {{-- <div class=" col col-lg-1 col-sm-2"> --}}
                            <button type="button" class="btn btn-light">
                                <a href="{{route('index_informes')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                                </a>
                            </button>
                        {{-- </div> --}}
                        {{-- <div class="col col-lg-2"> --}}
                            <h2 id="card_title">
                                {{ __('Informes Productos') }}
                            </h2>
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12" >
                            {{-- <form action="{{ route('report') }}" method="GET">
                                <div class="mb-3 row">
                                    <div class="col-sm-12" style="display: flex; margin-bottom: 1rem">
                                        <label class="col-lg-2" style="font-size: 1.3rem" for="">Nombre del Producto</label>
                                        <select name="product_filter" id="product_filter" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Producto</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ request('product_filter') == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name_product }}
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-12" style="display: flex; margin-bottom: 1rem"> 
                                        <label class="col-lg-2" style="font-size: 1.3rem"  for="">Categoria Producto</label>
                                        <select name="category_filter" id="category_filter" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Categorias del Producto</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category_filter') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-12" style="display: flex; margin-bottom: 1rem">
                                        <label class="col-lg-2" style="font-size: 1.3rem"  for="">Tipo de Producto</label>
                                        <select name="category_filter" id="category_filter" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Tipo</option>
                                                {{-- @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category_filter') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 ">
                                    <button type="submit" class=" btn btn-dark">Filtrar</button>
                                </div>
                            </form> --}}
                            <form action="{{ route('seleccionar-producto') }}" method="GET">
                                <label for="producto">Selecciona un producto:</label>
                                <select name="producto" id="producto">
                                    <option value="">Selecione uno</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->name_product }}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Ver Historial de Precios</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table_container">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="justify-content: center">
                            <thead class="table-dark">
                                <tr style="text-align: center">
                                    <th>Fecha de la venta </th>
                                    <th>Numero de Factura</th>
                                    <th>Precio del Producto</th>
                                    <th>Nombre del Producto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($historialPrecios as $historial)
                                        <tr>
                                            <td>{{ $historial->created_at }}</td>
                                            <td>{{ $historial->sale_id }}</td>
                                            <td>{{ $historial->selling_price }}</td>

                                            <td>{{ $historial->name_product }}</td> 
                                        </tr>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
                <div class="table_container">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="justify-content: center">
                            <thead class="table-dark">
                                <tr style="text-align: center">
                                    <th>Fecha de la venta </th>
                                    <th>Numero de Factura</th>
                                    <th>Nombre Producto</th>
                                    <th>Precio del Producto</th>
                                    <th>Acciones  </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($ventas as $sale)
                                        <tr>
                                            <td>{{ $sale->created_at }}</td>
                                            <td>{{ $sale->sale_id }}</td>
                                            <td>{{ $sale->productoId }}</td>
                                            <td>{{ $sale->selling_price }}</td>
                                            <td>
                                                <form action="{{ route('salesShow', ['sale' => $sale->id]) }}" method="get">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-fw fa-eye"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            {{-- <td>{{ $historial->name_product }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endauth
@guest
    @include('include.falta_sesion')
@endguest