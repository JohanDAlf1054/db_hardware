@auth

@include('include.barra', ['modo'=>'Informes'])
<br>
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-12">
          <div class="card card-default">
              <div class="card-header">
                  <h2 id="card_title">
                      {{ __('Informes') }}
                  </h2>
              </div>
            <div class="card-body">
              <div class="container px-0 py-0">
                  <div class="row g-4 py-5 row-cols-0 row-cols-lg-3">
                    <div class="col d-flex align-items-center">
                      <div class="card bg-light mb-3" style="max-width: 20rem; border-radius: 6%">
                        {{-- <div class="card-header">Informes de los Productos</div> --}}
                        <div class="card-body">
                          <h2>Informes de los Productos</h2>
                          <br>
                            <a class="btn btn btn-outline-dark" href="{{route('reportPriceHistoryProductsPurchase')}}" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe General de Productos
                            </a>
                            <a class="btn btn btn-outline-dark" href="{{route('historial')}}" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe de Movimientos
                            </a>
                            <a class="btn btn btn-outline-dark" href="" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe Historial de Precios
                            </a>
                            <a class="btn btn btn-outline-dark" href="" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe General de Productos
                            </a>
                        </div>
                      </div>
                    </div>

                    <div class="col d-flex align-items-start">
                      <div class="card bg-light mb-3" style="max-width: 20rem; border-radius: 6%">
                        {{-- <div class="card-header">Informes de los Productos</div> --}}
                        <div class="card-body">
                          <h2>Informes de las Ventas</h2>
                          <br>
                            {{-- <a class="btn btn btn-success " href="{{route('export')}}">
                              <i class="fa-solid fa-file-excel"></i> Excel
                            </a> --}}
                            <a class="btn btn btn-outline-dark" href="" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe General de Productos
                            </a>

                        </div>
                      </div>
                    </div>
                    <div class="col d-flex align-items-start">
                      <div class="card bg-light mb-3" style="max-width: 20rem; border-radius: 6%">
                        {{-- <div class="card-header">Informes de los Productos</div> --}}
                        <div class="card-body">
                          <h2>Informes de los Compras</h2>
                          <br>
                            {{-- <a class="btn btn btn-success " href="{{route('export')}}">
                              <i class="fa-solid fa-file-excel"></i> Excel
                            </a> --}}
                            <a class="btn btn btn-outline-dark" href="" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe General de Productos
                            </a>
                        </div>
                      </div>
                    </div>
                    <div class="col d-flex align-items-start">
                      <div class="card bg-light mb-3" style="max-width: 20rem; border-radius: 6%">
                        {{-- <div class="card-header">Informes de los Productos</div> --}}
                        <div class="card-body">
                          <h2>Informes de los Proveedores</h2>
                          <br>
                            {{-- <a class="btn btn btn-success " href="{{route('export')}}">
                              <i class="fa-solid fa-file-excel"></i> Excel
                            </a> --}}
                            <a class="btn btn btn-outline-dark" href="" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe General de Productos
                            </a>
                        </div>
                      </div>
                    </div>
                    <div class="col d-flex align-items-start">
                      <div class="card bg-light mb-3" style="max-width: 20rem; border-radius: 6%">
                        {{-- <div class="card-header">Informes de los Productos</div> --}}
                        <div class="card-body">
                          <h2>Informes de los Usuarios</h2>
                          <br>
                            {{-- <a class="btn btn btn-success " href="{{route('export')}}">
                              <i class="fa-solid fa-file-excel"></i> Excel
                            </a> --}}
                            <a class="btn btn btn-outline-dark" href="" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe General de Productos
                            </a>
                        </div>
                      </div>
                    </div>
                    <div class="col d-flex align-items-start">
                      <div class="card bg-light mb-3" style="max-width: 20rem; border-radius: 6%">
                        {{-- <div class="card-header">Informes de los Productos</div> --}}
                        <div class="card-body">
                          <h2>Informes de los Clientes</h2>
                          <br>
                            {{-- <a class="btn btn btn-success " href="{{route('export')}}">
                              <i class="fa-solid fa-file-excel"></i> Excel
                            </a> --}}
                            <a class="btn btn btn-outline-dark" href="" style="margin-bottom: 1rem">
                              <i class="fa-solid fa-file-pdf"></i> Informe General de Productos
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
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

