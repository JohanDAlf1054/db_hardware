<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <button type="button" class="btn btn-primary mx-2 rounded btn-lg" data-bs-toggle="modal" data-bs-target="#SaleModal" >Nuevo</a></button>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                           <input type="text" wire:model.live='criterio' class="form-control" placeholder="Buscar ...">
                        </div>
                        {{$criterio}}
                      </div>
                </div>

                <div class="container_datos">
                    <div class="table_container">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover" style="justify-content: center">
                            <thead class="table-dark">
                                <tr style="text-align: center">
                                    <th>Id</th>
                                    <th >Fecha</th>
                                    <th >Nº de factura</th>
                                    <th>Vendedor</th>
                                    <th>Forma de pago</th>
                                    <th>Observaciones</th>
                                    <th>Total descuento</th>
                                    <th>Total Bruto</th>
                                    <th>Total Impuesto</th>
                                    <th>Total Neto</th>
                                    <th>Total</th>  
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr style="text-align: center">
                                        <td>{{$sale->id}}</td>
                                        <td>{{$sale->dates}}</td>
                                        <td>{{$sale->bill_numbers}}</td>
                                        <td>{{$sale->sellers}}</td>
                                        <td>{{$sale->payments_methods}}</td>
                                        <td>{{$sale->observations}}</td>
                                        <td>{{$sale->discounts_total}}</td>
                                        <td>{{$sale->gross_totals}}</td>
                                        <td>{{$sale->taxes_total}}</td>
                                        <td>{{$sale->net_total}}</td>
                                        <td>{{$sale->values_total}}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <button wire:click="editar({{$sale->id}})" data-bs-toggle="modal" data-bs-target="#SaleModal" class="btn btn-sm btn-success">Editar</button>
                                            <button wire:click="borrar({{$sale->id}})" class="btn btn-danger btn-sm">Borrar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
           {{ $sales->links()}} 
        </div>
    </div>
    @include('sales.header')


    <label for="dates" class="form-label">Fecha: </label>
    <div class="input-group mb-3">
      <input type="date" class="form-control" id="dates" wire:model="dates">
    </div>

    <label for="bill_numbers" class="form-label">Numero de factura: </label>
    <div class="input-group mb-3">
      <input type="text" class="form-control" id="bill_numbers" wire:model="bill_numbers">
    </div>
    
    <label for="sellers" class="form-label">Vendedor: </label>
    <div class="input-group mb-3">
      <input type="text" class="form-control" id="sellers" wire:model="sellers">
    </div>

    <label for="payments_methods" class="form-label">Metodo de pago: </label>
    <div class="input-group mb-3">
      <input type="text" class="form-control" id="payments_methods" wire:model="payments_methods">
    </div>

    <label for="observations" class="form-label">Observaciones: </label>
    <div class="input-group mb-3">
      <input type="text" class="form-control" id="observations" wire:model="observations">
    </div>

    <label for="discounts_total" class="form-label">Descuento total: </label>
    <div class="input-group mb-3">
      <input type="number" class="form-control" id="discounts_total" wire:model="discounts_total">
    </div>

    <label for="gross_totals" class="form-label">Total Bruto: </label>
    <div class="input-group mb-3">
      <input type="number" class="form-control" id="gross_totals" wire:model="gross_totals">
    </div>

    <label for="taxes_total" class="form-label">Impuesto Total: </label>
    <div class="input-group mb-3">
      <input type="number" class="form-control" id="taxes_total" wire:model="taxes_total">
    </div>

    <label for="net_total" class="form-label">Total Neto: </label>
    <div class="input-group mb-3">
      <input type="number" class="form-control" id="net_total" wire:model="net_total">
    </div>

    <label for="values_total" class="form-label">Valor Total: </label>
    <div class="input-group mb-3">
      <input type="number" class="form-control" id="values_total" wire:model="values_total">
    </div>

    @include('sales.footer')
</div>