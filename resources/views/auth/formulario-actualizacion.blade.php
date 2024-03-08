<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <!-- <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/7604ee3851.js" crossorigin="anonymous"></script>
        <link href="{{ asset('css/estilos_inicio_sesion.css')}}" rel="stylesheet" />
        <link href="{{ asset('css/estilos_actualizar_contraseña.css')}}" rel="stylesheet"/>
        <title>Recuperacion de contraseña</title>
    </head>
    <body>

    <div class="blur">
        <div class="formulario_email">
            <div class="img_tory">
                <img src="{{ asset('img/logo-negro ampliado.png')}}" alt="img_ToryTech" />
            </div>
            <h2>Recuperar contraseña</h2>
            <hr class="linea">
                <form action="{{ route('actualizar-contrasenia') }}" method="POST">
                @csrf
                <p>Por favor completa los campos para cambiar tu contraseña.</p>
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email_address">Email</label>
                    <div>
                        <input type="text" id="email_address"  name="email" required autofocus>
                        <!-- @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif -->
                    </div>
                </div>

                <div>
                    <label for="password">Contraseña</label>
                    <div>
                        <input type="password" id="password" name="password" required autofocus>
                        <!-- @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif -->
                    </div>
                </div>

                <div>
                    <label for="password-confirm">Confirmar Contraseña</label>
                    <div>
                        <input type="password" id="password-confirm" name="password_confirmation" required autofocus>
                        <!-- @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif -->
                    </div>
                </div>

                <div class="errores">
                        <!-- If para la seleccion del correo electronico -->
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        @endif
                        <!-- If para la contraseña -->
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                        @endif
                        <!-- If para la confirmacion de la contraseña -->
                        @if ($errors->has('password_confirmation'))
                            <div class="alert alert-danger">
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            </div>
                        @endif
                </div>

                <div>
                    <button type="submit">
                        Cambiar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>
