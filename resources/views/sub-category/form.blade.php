<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group" style="margin-bottom: 16px">
            <label for="name" class="form-label" style="font-weight: bolder">
                {{ __('Nombre Sub Categoria') }}
                <span class="text-danger">*</span>
            </label>
            {{ Form::text('name', $subCategory->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre de la Sub Categoria']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group" style="margin-bottom: 16px">
            <label for="description" class="form-label" style="font-weight: bolder">
                {{ __('Descripción') }}
                <span class="text-danger">*</span>
            </label>
            {{ Form::text('description', $subCategory->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Breve Descripción']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <a class="btn btn btn-primary " href="{{ route('categorySub.index') }}">Back</a>
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>