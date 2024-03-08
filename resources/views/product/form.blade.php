@auth


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' >
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
</head>
<br>
<body>
  <div class="container-fluid">
      <div class="page-body">
        <div class="container-x1">
            <div class="row row-cards">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">

                                <div class="card-header">
                                <h3 class="card-title">
                                    {{ __('Imagen Producto') }}
                                </h3>
                                </div>
                                <div class="card-body">
                                <img class="img-account-profile mb-2" src="{{ asset('img/products/default.webp') }}" id="image-preview" width="400" height="400" />

                                <div class="small font-italic text-muted mb-2">
                                    JPG or PNG no sea mas grande de 2MB
                                </div>

                                @if (isset($producto->photo))
                                <img src="{{ asset('storage/' . $producto->photo) }}" width="400" height="400">
                                @endif

                                <input
                                    type="file"
                                    accept="image/*"
                                    id="image"
                                    name="photo"
                                    class="form-control @error('photo') is-invalid @enderror"
                                    onchange="previewImage();"
                                >

                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <div >
                                        <h3 class="card-title">
                                            {{ __('Producto') }}
                                        </h3>
                                    </div>
                                    <div class="card-actions">
                                        <a href="" class="btn-action">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <label for="validationProduct" class="form-label">
                                                {{ __('Nombre del Producto') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            {{ Form::text('name_product', $producto->name_product, ['class' => 'form-control' . ($errors->has('name_product') ? ' is-invalid' : ''), 'placeholder' => 'Nombre', 'id' => 'validationProduct']) }}
                                            {!! $errors->first('name_product', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                              <label for="category_id" class="form-label">
                                                {{ __('Categoria Producto') }}
                                                    <span class="text-danger">*</span>
                                              </label>
                                              {{ Form::select('category_products_id', $categorias, $producto->category_products_id, ['class' => 'form-control selectpicker' . ($errors->has('category_products_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la categoria', 'data-live-search' => 'true']) }}
                                              {!! $errors->first('category_products_id', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="unidades_id">
                                                    {{ __('Unidad') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::select('measurement_units_id', $unidades, $producto->measurement_units_id, ['class' => 'form-control selectpicker' . ($errors->has('measurement_units_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona la unidad', 'data-live-search' => 'true'] ) }}
                                                {!! $errors->first('measurement_units_id', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                            <label class="form-label" for="tax_type">
                                                {{ __('Clasificacion Tributaria') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            {{ Form::select('classification_tax', ['Excluido' => 'Excluido', '0%' => '0%', '5%' => '5%', '19%' => '19%'] ,$producto->classification_tax, ['class' => 'form-select' . ($errors->has('classification_tax') ? ' is-invalid' : ''), 'placeholder' => 'Selecione Una']) }}
                                            {!! $errors->first('classification_tax', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label class="form-label" for="tax_type">
                                                {{ __('Referencia Fabrica') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            {{ Form::text('factory_reference', $producto->factory_reference, ['class' => 'form-control' . ($errors->has('factory_reference') ? ' is-invalid' : ''), 'placeholder' => 'Referencia de Fabrica']) }}
                                            {!! $errors->first('factory_reference', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label class="form-label" for="tax_type">
                                                {{ __('Marca') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            {{ Form::select('brands_id', $marcas, $producto->brands_id, ['class' => 'form-control selectpicker' . ($errors->has('brands_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona una marca', 'data-live-search' => 'true']) }}
                                            {!! $errors->first('brands_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">
                                                    {{ __('Descripción') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::textarea('description_long', $producto->description_long, ['class' => 'form-control' . ($errors->has('description_long') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Producto', 'rows' => '3']) }}
                                                {!! $errors->first('description_long', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <a class="btn btn btn-primary " href="{{ route('products.index') }}">Back</a>
                                    <button class="btn btn btn-success" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('js/img-preview.js') }}"></script>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
</body>
</html>
@endauth
@guest
    @include('include.falta_sesion')
@endguest

