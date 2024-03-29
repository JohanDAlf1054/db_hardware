{{-- <div class="box box-info padding-1"> --}}
    <div class="box-body">

        <div class="row">
            <div class="col">
                {{ Form::label('Nombre de la Categoria') }}
                {{ Form::text('name', $categoryProduct->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('Sub Categoria') }}
                {{ Form::select('sub_categories_id', $SubCategory ,$categoryProduct->sub_categories_id, ['class' => 'form-control' . ($errors->has('sub_categories_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecione una categoria']) }}
                {!! $errors->first('sub_categories_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('Descripcion') }}
                {{ Form::text('description', $categoryProduct->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Breve']) }}
                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
        
    </div> <br>
    <div class="box-footer mt20">
        <a  class="btn btn btn-primary" href="{{ route('products.index') }}">Back</a>
        <button type="submit" class="btn btn-success ">{{ __('Submit') }}</button>
    </div>
</div>