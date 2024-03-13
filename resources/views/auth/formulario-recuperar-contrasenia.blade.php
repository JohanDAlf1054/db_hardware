<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <!-- <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/7604ee3851.js" crossorigin="anonymous"></script>
        <link href="css/estilos_inicio_sesion.css" rel="stylesheet" />
        <link href="css/estilos_recuperar_contraseña.css" rel="stylesheet"/>
        <title>Recuperacion de contraseña</title>
    </head>
    <body>

    <div class="blur">
        <div class="formulario_email">
            <div class="img_tory">
                <img src="{{ asset('img/logo-negro ampliado.png')}}" alt="img_ToryTech" />
            </div>
            <h2>¿Olvidaste tu contraseña?</h2>
            <hr class="linea">
            <form action="{{ route('enviar-recuperacion') }}" method="POST">
                <p>Te enviaremos un correo con la informacion necesaria para poder restablecerla.</p>
                @csrf
                <div>
                    <label for="email_address">Tu Email</label>
                    <br>
                        <input type="text" id="email_address" class="" name="email" required autofocus>
                        <br>
                        <br>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                </div>
                <div class="mensaje_confirmation">
                    @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                </div>
                <div class="">
                    <button type="submit" class="">
                        Enviar Email de recuperacion
                    </button>

                    <button class="boton_regresar">
                        <a href="/login">Regresar</a>
                    </button>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>
