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
                <div class="card-header">
                    <h2 id="card_title">
                        {{ __('Informes Productos') }}
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12" >
                            <form action="{{ route('report') }}" method="GET">
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
                                                @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 ">
                                    <button type="submit" class=" btn btn-dark">Filtrar</button>
                                </div>
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
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Referencia Proveedor</th>
                                    <th>Proveedor</th>
                                    <th>Estado Producto</th>
                                    <th>Comprobante</th>
                                    <th>Impuesto a Cargo</th>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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