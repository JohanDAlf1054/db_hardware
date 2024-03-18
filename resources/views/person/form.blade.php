@auth

@include('include.barra', ['modo'=>'Personas'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Persona</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' >
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>
<br>
<style>
    #box-razon-social{
        display: none;
    }
    #box-first-name{
        display: none;
    }
    #box-other-name{
        display: none;
    }
    #box-surname{
        display: none;
    }
    #box-second-surname{
        display: none;
    }
</style>
<body>
    <div class="content container-fluid">
        <div class="page-body">
            <div class="container-x1">
                <div class="row row-cards">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header" style="display: flex">
                                        <h3 class="card-title">
                                            {{__('Persona')}}
                                        </h3>
                                        <div class="card-actions" style="padding-top: 9px; padding-left: 20px" >
                                            <a href="" class="btn-action">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cards">
                                    {{--  Rol  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="md-3" style="margin-bottom: 16px">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Tercero') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::select('rol', ['Cliente' => 'Cliente', 'Proveedor' => 'Proveedor'],$person->rol, ['class' => 'form-select' . ($errors->has('rol') ? ' is-invalid' : ''), 'placeholder' => 'Seleciona una opción']) }}
                                                {!! $errors->first('rol', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                            {{--  Tipo de identificacion  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="md-3" style="margin-bottom: 16px">
                                                <label for="identification_type" class="form-label" style="font-weight: bolder">
                                                    {{ __('Tipo de identificación') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::select('identification_type', ['CC' => 'Cédula de Ciudadanía', 'CE' => 'Cédula de Extranjería', 'DIE' => 'Documento de Identificación Extranjero', 'NIT' => 'NIT', 'NITO' => 'NIT de otro pais', 'NUIP' => 'NUIP', 'PP' => 'Pasaporte','PEP' => 'Permiso especial de permanencia','RC' => 'Registro civil','TE' => 'Tarjeta de extranjeria','TI' => 'Tarjeta de identidad'],$person->identification_type, ['class' => 'form-select' . ($errors->has('identification_type') ? ' is-invalid' : ''), 'placeholder' => 'Seleciona una opción']) }}
                                                {!! $errors->first('identification_type', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                        {{--  Numero de identificacion   --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="identification_number" class="form-label" id="identification_number" style="font-weight: bolder">
                                                {{ __('Número de identificación')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::text('identification_number', $person->identification_number, ['id' => 'identification_number1','class' => 'form-control' . ($errors->has('identification_number') ? ' is-invalid' : ''), 'placeholder' => 'Número de identificación']) }}
                                                {!! $errors->first('identification_number', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                        {{--  Digito de verificacion  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="digit_verification" id="digit_verification" class="form-label" style="font-weight: bolder">
                                                {{ __('Dígito de verificación')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::number('digit_verification', $person->digit_verification, ['id' => 'digit_verification1','class' => 'form-control' . ($errors->has('identification_number') ? ' is-invalid' : ''), 'placeholder' => 'Dígito de verificación', 'readonly' => 'readonly']) }}
                                                {!! $errors->first('digit_verification', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        <!-- Script para sacar eldigito de verificacion -->
                                        <script src="{{ asset('js/formularios_digito_de_verificacion.js') }}"></script>

                                        {{--  Tipo de persona  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="person_type" class="form-label" style="font-weight: bolder">
                                                {{ __('Tipo de persona')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::select('person_type', ['Persona natural' => 'Persona natural', 'Persona jurídica' => 'Persona juridica'],$person->person_type, ['id' => 'person_type','class' => 'form-select' . ($errors->has('person_type') ? ' is-invalid' : ''), 'placeholder' => 'Seleciona una opción']) }}
                                                {!! $errors->first('person_type', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>


                                        {{--  Nombre de compañia  --}}
                                        <div class="col-sm-6 md-6" id="box-razon-social">
                                            <div class="mb-3">
                                                    <label for="company_name" class="form-label" style="font-weight: bolder">
                                                    {{ __('Razon social')}}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    {{ Form::text('company_name', $person->company_name, ['id'=> 'company_name','class' => 'form-control' . ($errors->has('company_name') ? ' is-invalid' : ''), 'placeholder' => 'Razón social']) }}
                                                    {!! $errors->first('company_name', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-cards">
                                            {{--  Primer Nombre  --}}
                                                <div class="col-sm-6 md-6" id="box-first-name">
                                                    <div class="mb-3">
                                                            <label for="first_name" class="form-label" style="font-weight: bolder">
                                                            {{ __('Primer nombre')}}
                                                            <span class="text-danger">*</span>
                                                            </label>
                                                            {{ Form::text('first_name', $person->first_name, ['class' => 'form-control' . ($errors->has('first_name') ? ' is-invalid' : ''), 'placeholder' => 'Primer nombre']) }}
                                                            {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                </div>

                                            {{--  Segundo nombre   --}}

                                                <div class="col-sm-6 md-6" id="box-other-name">
                                                    <div  class="mb-3" style="">
                                                            <label for="other_name" class="form-label" style="font-weight: bolder">
                                                            {{ __('Otro nombre')}}
                                                            <span class="text-danger">*</span>
                                                            </label>
                                                            {{ Form::text('other_name', $person->other_name, ['class' => 'form-control' . ($errors->has('other_name') ? ' is-invalid' : ''), 'placeholder' => 'Otro nombre',  ]) }}
                                                            {!! $errors->first('other_name', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                </div>

                                            {{--  Apellido   --}}

                                                <div class="col-sm-6 md-6" id="box-surname">
                                                    <div class="mb-3">
                                                            <label for="surname" class="form-label" style="font-weight: bolder">
                                                            {{ __('Apellido')}}
                                                            <span class="text-danger">*</span>
                                                            </label>
                                                            {{ Form::text('surname', $person->surname, ['class' => 'form-control' . ($errors->has('surname') ? ' is-invalid' : ''), 'placeholder' => 'Primer apellido', ]) }}
                                                            {!! $errors->first('surname', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                </div>

                                            {{--  Segundo apellido  --}}

                                                <div class="col-sm-6 md-6" id="box-second-surname">
                                                    <div class="mb-3">
                                                            <label for="second_surname" class="form-label" style="font-weight: bolder">
                                                            {{ __('Segundo Apellido')}}
                                                            <span class="text-danger">*</span>
                                                            </label>
                                                            {{ Form::text('second_surname', $person->second_surname, ['class' => 'form-control' . ($errors->has('second_surname') ? ' is-invalid' : ''), 'placeholder' => 'Segundo apellido',]) }}
                                                            {!! $errors->first('second_surname', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                </div>

                                        {{--  Correo electronico  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="email_address" class="form-label" style="font-weight: bolder">
                                                {{ __('Correo electrónico')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::text('email_address', $person->email_address, ['class' => 'form-control' . ($errors->has('email_address') ? ' is-invalid' : ''), 'placeholder' => 'Correo electrónico']) }}
                                                {!! $errors->first('email_address', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        {{--  Ciudad  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label" style="font-weight: bolder">
                                                {{ __('Ciudad')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::text('city', $person->city, ['class' => 'form-control' . ($errors->has('city') ? ' is-invalid' : ''), 'placeholder' => 'Ciudad']) }}
                                                {!! $errors->first('city', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        {{--  Direccion  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label" style="font-weight: bolder">
                                                {{ __('Dirección')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                {{ Form::text('address', $person->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
                                                {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        {{--  Número de celular  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label" style="font-weight: bolder">
                                                {{ __('Número telefónico')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                    {{ Form::text('phone', $person->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Número telefónico']) }}
                                                    {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}

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


    <div class="card-footer text-end">
        <a class="btn btn-primary" style="margin-right: 5rem" href="{{ route('person.index') }}">Regresar</a>
        <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
    </div>


{{--  Escript para escojer el tipo de persona  --}}
<script>
    $(document).ready(function(){
        $('#person_type').on('change',function(){
            let selectValue = $(this).val();
            //Escoger los valores de natural o juridica
            if(selectValue == 'Persona natural'){
                $('#box-razon-social').hide();
                $('#box-first-name').show();
                $('#box-other-name').show();
                $('#box-surname').show();
                $('#box-second-surname').show();
            }else{
                $('#box-first-name').hide();
                $('#box-other-name').hide();
                $('#box-surname').hide();
                $('#box-second-surname').hide();
                $('#box-razon-social').show();
            }
        });
    });
</script>
</body>
</html>
@endauth
@guest
    @include('include.falta_sesion')
@endguest

