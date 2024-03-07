<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('people_id') }}
            {{ Form::text('people_id', $supplier->people_id, ['class' => 'form-control' . ($errors->has('people_id') ? ' is-invalid' : ''), 'placeholder' => 'People Id']) }}
            {!! $errors->first('people_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>