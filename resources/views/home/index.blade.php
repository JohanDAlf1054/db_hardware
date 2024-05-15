@auth
@include('include.barra', ['modo' => 'Inicio'])
<br>
<div class="contenedor-toast" id="contenedor-toast">
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos_footer.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/dashboard/panel.css')}}">
    <script src="{{ asset('js/tooltips.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
<body>
    <div class="container-fluid px-5 py-3">
        <div class="col-sm-12">
            <!-- ========== Contenedores de Estadisticas ========== -->
            <div class="title">
                <h2>Panel Estadistícas</h2>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card-sales">
                        <div class="content">
                            <div class="info"> 
                                <h6 class="mb-10">Total Ventas Hoy</h6>
                                <h3 class="text-bold mb-10" style="color: rgb(17, 198, 0)">{{'$' . $totalVentasHoy }}</h3>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <i class="fa-solid fa-truck-fast fa-2xl" style="color: #6C9BCF"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card-default">
                        <div class="content">
                            <a class="info" href="{{route('sales.index')}}"> 
                                <h6 class="mb-10">Total de Ventas Realizadas </h6>
                                <h3 class="text-bold mb-10">{{{$sales}}}</h3>
                            </a>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <i class="fa-solid fa-cart-shopping fa-2xl" style="color: #1B9C85"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card-searches">
                        <div class="content">
                            <a class="info" href="{{route('detail-purchases.index')}}"> 
                                <h6 class="mb-10">Total de Compras Realizadas</h6>
                                <h3 class="text-bold mb-10">{{$purchase}}</h3>
                            </a>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <i class="fa-brands fa-shopify fa-2xl" style="color: #F7D060"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card-visits">
                        <div class="content">
                            <a class="info" href="{{route('products.index')}}"> 
                                <h6 class="mb-10">Total de Productos Existentes</h6>
                                <h3 class="text-bold mb-10">{{$productos}}</h3>
                            </a>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <i class="fa-brands fa-product-hunt fa-2xl" style="color: #FF0060"></i>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
            <!--Admin-->
            <div class="col col-sm-8 col-lg-3">
                <div class="card-style mb-30">
                    <div class="user-profile">
                        <div class="logo">
                            @if(auth()->user()->hasRole('Administrador'))
                                <img src="{{ asset('img/dashboard/logo_admin.png') }}">
                            @elseif(auth()->user()->hasRole('Trabajador'))
                                <img src="{{ asset('img/dashboard/logo_empleado.png') }}">
                            @else
                                <img src="{{ asset('img/dashboard/logo_panel.png') }}">
                            @endif
                            @if(auth()->user()->roles->count() > 0)
                                <h2 >
                                    @foreach (auth()->user()->roles as $role)
                                        <p class="badge bg-dark">{{ $role->name }}</p>
                                    @endforeach
                                </h2>
                            @else
                                <h2 style="margin-top: 20%">
                                    <p class="badge bg-dark" >Sin Rol</p>
                                </h2>
                            @endif
                            <h5 style="margin-top: -9%" >{{ auth()->user()->name }}</h5>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-9">
                    <div class="card-style mb-30">
                      <div class="title d-flex flex-wrap justify-content-between align-items-center">
                        <div class="left">
                          <h6 class="text-medium mb-30">Productos con pocas existencias</h6>
                        </div>
                      </div>
                      <div >
                        <table class="table table-striped table-hover" id="example3" style="width: 100%" >
                          <thead class="table-dark" >
                            <tr >
                              <th><h6 class="text-sm text-medium" style="text-align: left;">Nombre Producto</h6></th>
                              <th><h6 class="text-sm text-medium" style="text-align: left;">Límite de Existencias</h6></th>
                              <th><h6 class="text-sm text-medium" style="text-align: left;">Precio de Venta</h6></th>
                              <th><h6 class="text-sm text-medium" style="text-align: left;">Acción</h6></th>
                          </thead>
                          <tbody>
                            @foreach ( $dataProduct as $data )
                                <tr>
                                    <td style="text-align: left;">{{ $data->name_product}}</td>
                                    <td style="text-align: left;">
                                        <p class="badge rounded-pill bg-danger">{{ $data->stock}}</p>
                                    </td>
                                    <td style="text-align: left;">{{ $data->selling_price }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary " tooltip="tooltip"
                                            title="Aumentar Exixtencias" href="{{ route('detail-purchases.create') }}">
                                            <i class="fa-solid fa-cart-shopping"></i> 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{ $dataProduct->links() }}
                      </div>
                    </div>
                  </div>
              </div>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-style mb-30">
                      <div class="title d-flex flex-wrap justify-content-between align-items-center">
                        <div class="left">
                          <h6 class="text-medium mb-30">Compras Recientes</h6>
                        </div>
                      </div>
                      <div >
                        <table class="table top-selling-table" id="example" style="width: 100%">
                          <thead class="table-dark" >
                            <tr>
                              <th><h6 class="text-sm text-medium" style="text-align: left;">N° Factura</h6></th>
                              <th><h6 class="text-sm text-medium" style="text-align: left;">Fecha</h6></th>
                              <th><h6 class="text-sm text-medium" style="text-align: left;">Proveedor</h6></th>
                              <th><h6 class="text-sm text-medium" style="text-align: left;">Forma de Pago</h6></th>
                              <th><h6 class="text-sm text-medium" style="text-align: left;">Total</h6></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ( $purchaseToday as $data )
                                <tr>
                                    <td style="text-align: left;">{{ $data->id}}</td>
                                    <td style="text-align: left;">{{ $data->date_purchase}}</td>
                                    <td style="text-align: left;">{{ $data->purchaseSupplier->person->first_name }}</td>
                                    <td style="text-align: left;">{{ $data->form_of_payment }}</td>
                                    <td style="text-align: left; color: rgb(17, 198, 0)">{{ $data->total_value }}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{ $purchaseToday->links() }}

                      </div>
                    </div>
                  </div>
                <!-- End Col -->
                <div class="col-lg-6">
                  <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between align-items-center">
                      <div class="left">
                        <h6 class="text-medium mb-30">Ventas recientes</h6>
                      </div>
                    </div>
                    <div >
                      <table class="table top-selling-table" id="example2" style="width: 100%">
                        <thead class="table-dark" >
                          <tr>
                            <th><h6 class="text-sm text-medium" style="text-align: left;">N° Factura</h6></th>
                            <th><h6 class="text-sm text-medium" style="text-align: left;">Fecha</h6></th>
                            <th><h6 class="text-sm text-medium" style="text-align: left;">Vendedor</h6></th>
                            <th><h6 class="text-sm text-medium" style="text-align: left;">Forma de Pago</h6></th>
                            <th><h6 class="text-sm text-medium" style="text-align: left;">Total</h6></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $salesToday as $data )
                            <tr>
                                <td style="text-align: left;">{{ $data->bill_numbers}}</td>
                                <td style="text-align: left;">{{ $data->dates}}</td>
                                <td style="text-align: left;">{{ $data->sellers}}</td>
                                <td style="text-align: left;">{{ $data->payments_methods}}</td>
                                <td style="text-align: left; color: rgb(17, 198, 0)">{{ $data->net_total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $salesToday->links() }}
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    <script src="{{ asset('js/datablesB.js') }}"></script>
</body>
</html>
@endauth
@guest
    @include('include.falta_sesion')
@endguest
