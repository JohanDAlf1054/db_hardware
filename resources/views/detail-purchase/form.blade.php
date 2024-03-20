@auth
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Accesos Dirrectos </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

 <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>


</head>
<body>
   
    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        // Tu código JavaScript aquí
    </script>
@endpush

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="bx bx-menu"></i>
                    </button>
                    <span class="Titulo"> NUEVA COMPRA <br></span> 
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                         
                            
                        </ul> <br>
                    </div>
                </div>
            </nav>
            <div class="container">
                <form action="{{ route('detail-purchases.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="container-lg mt-4">
        <div class="row gy-4">
            <!------Compra producto---->
            <div class="col-xl-8">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de la compra
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row">
                        
                        <div class="col-6 mb-4">
                            <label for="producto_id" class="form-label">Producto:</label>
                            <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" data-size="1" title="Busque un producto aquí">
                                <option value="">Seleccionar un producto</option>
                                @foreach ($products as $item)
                                    <option value="{{$item->id}}" data-selling-price="{{$item->selling_price}}" data-classification-tax="{{$item->classification_tax}}">
                                        {{$item->name_product}}
                                    </option>
                                @endforeach
                            </select>
                            
                            
                        </div>
                        
                        <div class="col-6 mb-2">
                            <label for="identification_type" class="form-label">Tipo de identificación:</label>
                            <input type="text" id="identification_type" name="identification_type" class="form-control" value="{{ old('identification_type', isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) && isset($detailPurchase->purchaseSupplier->person) ? $detailPurchase->purchaseSupplier->person->identification_type : '') }}">
                            @error('identification_type')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-6 mb-2">
                            <label for="identification_number" class="form-label">Número de identificación:</label>
                            <input type="text" id="identification_number" name="document_number" required class="form-control" value="{{ old('document_number', isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) && isset($detailPurchase->purchaseSupplier->person) ? $detailPurchase->purchaseSupplier->person->identification_number : '') }}">
                            @error('identification_number')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-6 mb-4">
                            <label for="fecha" class="form-label">Fecha de Compra:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ old('date_purchase', isset($detailPurchase) ? $detailPurchase->date_purchase : '') }}">
                            @error('fecha')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        <div class="col-6 mb-4">
                            <label for="factura" class="form-label">Número de factura</label>
                            <select id="factura" name="factura" class="form-control" data-size="2" title="Busque un Numero De Factura aquí">
                                <option value="">Seleccionar un Numero De Factura</option>
                                @foreach ($purchase_suppliers as $purchaseSupplier)
                                    @if (!empty($purchaseSupplier->invoice_number_purchase))
                                        <option value="{{ $purchaseSupplier->invoice_number_purchase }}" data-date="{{ $purchaseSupplier->date_invoice_purchase }}">
                                            {{ $purchaseSupplier->invoice_number_purchase }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>                            
                            @error('factura')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        
                        
                        
                        <div class="col-6 mb-4">
                            <label for="product_tax" class="form-label">Impuesto a cargo del producto</label>
                            <select id="product_tax" name="product_tax" class="form-control">
                                <option value="0" {{ old('product_tax', isset($detailPurchase) ? $detailPurchase->product_tax : '') == 0 ? 'selected' : '' }}>0%</option>
                                <option value="5" {{ old('product_tax', isset($detailPurchase) ? $detailPurchase->product_tax : '') == 5 ? 'selected' : '' }}>5%</option>
                                <option value="19" {{ old('product_tax', isset($detailPurchase) ? $detailPurchase->product_tax : '') == 19 ? 'selected' : '' }}>19%</option>
                            </select>
                            @error('product_tax')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-sm-4 mb-2">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control">
                        </div>

                        <div class="col-sm-4 mb-2">
                            <label for="precio_compra" class="form-label">Precio de Unitario:</label>
                            <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.1">
                        </div>

                        <div class="col-sm-4 mb-2">
                            <label for="precio_venta" class="form-label"> Descripcion:</label>
                            <input type="text" name="precio_venta" id="precio_venta" class="form-control" step="0.1">
                        </div>

                        <div class="col-12 mb-4 mt-2 text-end">
                            <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                        </div>
                        
                        
                        
                       
                    
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tabla_detalle" class="table table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white">#</th>
                                            <th class="text-white">Producto</th>
                                            <th class="text-white">Cantidad</th>
                                            <th class="text-white">Descripcion</th>
                                            <th class="text-white">Impuesto</th>
                                            <th class="text-white">Precio Unitario</th>
                                            <th class="text-white">Sub Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Sumas</th>
                                            <th colspan="2"><span id="sumas">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">IGV %</th>
                                            <th colspan="2"><span id="igv">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total</th>
                                            <th colspan="2"><span id="total">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Bruto</th>
                                            <th colspan="2"> <span id="totalBruto"><input type="hidden" name="gross_total" id="gross_total">
                                                0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Neto</th>
                                            <th colspan="2"> <span id="totalNeto">0</span></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                                
                        <div class="col-12 mt-2">
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancelar compra
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-----Compra---->
            <div class="col-xl-4">
                <div class="text-white bg-success p-1 text-center">
                    Datos generales
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row">
                        <!--Proveedor-->
                        <div class="col-12 mb-2">
                            <label for="people_id" class="form-label">Proveedor:</label>
                            <select name="people_id" id="people_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                            <option value="">Seleccione un Proveedor</option>
                                @foreach ($people as $person)
                                    <option value="{{$person->id}}" data-identification-type="{{$person->identification_type}}" data-identification-number="{{$person->identification_number}}">
                                        {{$person->first_name}}
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('people_id')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        
                        
                        
                        <div class="col-6 mb-2">
                            <label for="discount_total" class="form-label">Descuento Total (%):</label>
                            <input type="number" id="discount_total" name="discount_total" min="0" max="100" step="1" class="form-control" placeholder="Ingrese el porcentaje de descuento" oninput="this.value = Math.round(this.value)" value="{{ old('discount_total', isset($detailPurchase) ? $detailPurchase->discount_total : '') }}">
                            @error('discount_total')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        
                        
                        
                        

                        <!--Impuesto---->
                  

                            <div class="col-sm-6 mb-2">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input readonly type="date" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                            </div>
                                <div class="col-6 mb-2">
                                
                                    <label for="form_of_payment" class="form-label">Formas de pago:</label>
                                    <select id="form_of_payment" name="form_of_payment" class="form-control" onchange="checkPaymentMethod(this)">
                                        <option value="">Seleccionar forma de pago</option>
                                        <option value="tarjeta" {{ old('form_of_payment', isset($detailPurchase) ? $detailPurchase->form_of_payment : '') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                        <option value="efectivo" {{ old('form_of_payment', isset($detailPurchase) ? $detailPurchase->form_of_payment : '') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                    </select>
                                    @error('form_of_payment')
                                    <small class="text-danger">{{ '*'.$message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-6 mb-2">
                                    <label for="method_of_payment" class="form-label">Método de Pago:</label>
                                    <select id="method_of_payment" name="method_of_payment" class="form-control">
                                        <option value="">Seleccione un metodo de pago</option>
                                        <option value="cuotas">Cuotas</option>
                                        <option value="contado">Contado</option>
                                        <!-- Agrega aquí las demás opciones que necesites -->
                                    </select>
                                    @error('method_of_payment')
                                    <small class="text-danger">{{ '*'.$message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-success" id="guardar">Realizar compra</button>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Seguro que quieres cancelar la compra?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnCancelarCompra" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        
        </form>

        <script>
        $(document).ready(function(){
    $('#btn_agregar').click(function(){
        agregarProducto();
    });
});
let cont=0;
let subtotal=[];
let sumas=0;
let igv=0;
let total=0;
let totalBruto=0;
let totalNeto = 0; 

function agregarProducto(){
    let idProducto = $('#producto_id').val();
    let nameProducto = $('#producto_id option:selected').text();
    let cantidad=$('#cantidad').val();
    let descripcion=$('#precio_venta').val();
    let impuesto=$('#product_tax').val();
    let precioCompra=$('#precio_compra').val();
//calcular valores
subtotal[cont] = cantidad * precioCompra;
sumas += subtotal[cont]; 
igv = sumas * impuesto / 100; 
total = sumas + igv; 
totalBruto = sumas; 
totalNeto = total; 
$('#gross_total').val(totalBruto);

    let fila='<tr>'+
        '<th>'+ (cont+1) +'</th>'+
        '<td>'+ nameProducto +'</td>'+
        '<td>'+ cantidad +'</td>'+
        '<td>'+ descripcion +'</td>'+
        '<td>'+ impuesto +'</td>'+
        '<td>'+ precioCompra +'</td>'+
        '<td>'+ subtotal[cont] +'</td>'+

        '</tr>';
        $('#tabla_detalle').append(fila);
        limpiarCampos();
        cont++;
        $('#sumas').html(sumas);
        $('#igv').html(igv);
        $('#total').html(total);
        $('#totalBruto').html(totalBruto);
        $('#totalNeto').html(totalNeto);
}
function limpiarCampos(){
    //let select=$('#producto_id');
    //select.val(''); // Restablece el valor a vacío
    //$('#cantidad').val('');
    //$('#precio_venta').val('');
    //$('#precio_compra').val('');
}

        </script>
        <script>
            document.getElementById('factura').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var date = selectedOption.getAttribute('data-date');
    document.getElementById('fecha').value = date;
});

        </script>
        <script>
            document.getElementById('people_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var identificationType = selectedOption.getAttribute('data-identification-type');
    var identificationNumber = selectedOption.getAttribute('data-identification-number');
    document.getElementById('identification_type').value = identificationType;
    document.getElementById('identification_number').value = identificationNumber;
});

        </script>
        <script>
  document.getElementById('producto_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var sellingPrice = selectedOption.getAttribute('data-selling-price');
    var classificationTax = selectedOption.getAttribute('data-classification-tax');
    
    // Si classificationTax es nulo o vacío, establecerlo en 0
    if (classificationTax === null || classificationTax === '') {
        classificationTax = 0;
    }

    document.getElementById('precio_compra').value = sellingPrice;
    document.getElementById('product_tax').value = classificationTax;
});




        </script>
    @endauth