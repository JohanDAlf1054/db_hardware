<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('code') }}
            {{ Form::text('code', $measurementUnit->code, ['class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''), 'placeholder' => 'Code']) }}
            {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $measurementUnit->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>