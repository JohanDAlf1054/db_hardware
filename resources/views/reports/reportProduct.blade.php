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
                                {{ __('Informe Historial de Precios') }}
                            </h2>
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>
                <div class="card-body">
                    <div class="row">
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
                                                <tr style="text-align: center">
                                                    <td>{{ $sale->created_at->format('d/m/Y H:i:s') }}</td>
                                                    <td>{{ $sale->sale_id }}</td>
                                                    <td>{{ $sale->producto->name_product }}</td>
                                                    <td>{{ $sale->selling_price }}</td>
                                                    <td>
                                                        <form action="{{ route('sales.show', ['sale' => $sale]) }}" method="get">
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-fw fa-eye"></i>
                                                            </button>
                                                        </form>
                                                    </td>
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
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endauth
@guest
    @include('include.falta_sesion')
@endguest