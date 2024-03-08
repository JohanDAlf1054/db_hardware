<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <!-- <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/> -->
        <script src="https://kit.fontawesome.com/7604ee3851.js" crossorigin="anonymous"></script>
        <link href="css/estilos_inicio_sesion.css" rel="stylesheet" />
        <title>ToryTech</title>
    </head>
    <body>
    <div class="img_tory">
        <img src="{{ asset('img/Fondo_negro.png')}}" alt="" />
    </div>
    <!-- inicio del formulario -->
    <main>
        <div class="contenedor_todo">
            <div class="caja_trasera">
                <div class="caja-tra-login">
                <h3>¿Ya estas registrado?</h3>
                <p>Inicio sesion para entrar en la pagina</p>
                <button id="btn_iniciar_sesion">Iniciar Sesion</button>
            </div>

            <div class="caja-tra-register">
                <h3>¿Aun no tienes una cuenta?</h3>
                <p>Registrate para Iniciar secion</p>
                <button id="btn_registrarse">Registrarse</button>
            </div>
        </div>


        <div class="contenedor_login-registro">
            <!-- Formulario para el login del usuario -->
            <form action="/login" method="POST" class="formulario_login" id="formulario">
            @csrf
            <h2>Iniciar sesion</h2>
            <hr />

            <!-- Div para el error de email. -->
            <div>
                <div class="aparecer_desaparecer error_email" id="error_email">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <!-- Div para el error de contraseña -->
            <div>
                <div class="aparecer_desaparecer error_password" id="error_password">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <!-- Grupo para el input de usuario -->
            <div class="formulario__grupo" id="grupo__name">
                <label for="name" class="formulario__label">Usuario</label>
                <div class="formulario__grupo-input">
                    <input type="text"  name="name" autofocus value="{{ old('name') }}" placeholder="Correo electronico" class="formulario__input input_inicio" id="name"/>
                    <i class="formulario__validacion-estado far fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Este campo debe contener un correo electronico registrado</p>
            </div>
            <br>
            <!-- Grupo del input para la contraseña -->
            <div class="formulario__grupo" id="grupo__password">
                <label for="password" class="formulario__label">Contraseña</label>
                <div class="formulario__grupo-input">
                    <input type="password" class="formulario__input input_inicio" name="password" id="password" placeholder="Contraseña">
                    <i class="formulario__validacion-estado far fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
            </div>

            <!-- Mensaje de aviso -->
            <div class="formulario__mensaje" id="formulario__mensaje">
                <p><i class="icon_error fa-solid fa-triangle-exclamation fa-xl"></i><b>Error: </b>Por favor complete el formulario correctamenete </p>
            </div>

            <!-- Div para el reseteo de contraseña -->
            <div class="reset_password">
                <a class="forward_password" href="{{ route('formulario-recuperar-contrasenia') }}">
                    ¿Olvido su contraseña?
                </a>
            </div>
            <!-- Boton de envio del formulario -->
            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <button type="submit" class="formulario__btn" id="btn-iniciar_sesion">Enviar</button>
            </div>

            </form>
            <script src="js/formulario.js"></script>
            <script src="js/ocultar_mensaje.js"></script>


            <!-- Formulario para registrarse -->
            <form action="/register" method="POST" class="formulario_registro" id="formulario_registro">
            @csrf
            <h2>Registrarse</h2>
            <hr class="formulario_registro_linea" />

            <!-- Grupo para el nombre -->
            <div class="formulario__grupo" id="grupo__nombre">
                <label for="nombre" class="formulario__label">Nombre completo</label>
                <div class="formulario__grupo-input">
                    <input type="text" name="name" class="formulario__input" placeholder="Jhon Doe" id="nombre">
                    <i class="formulario__validacion-estado far fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El nombre no debe de contener numeros o caracteres especiales</p>
            </div>

            <!-- Grupo para el correo electronico -->
            <div class="formulario__grupo" id="grupo__email">
                <label for="email" class="formulario__label">Correo electronico</label>
                <div class="formulario__grupo-input">
                    <input type="email" class="formulario__input" name="email" placeholder="JhonDoe@gmail.com" id="email">
                    <i class="formulario__validacion-estado far fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guin bajo.</p>
            </div>

            <!-- Grupo para el telefono -->
            <div class="formulario__grupo" id="grupo__phone_number">
                <label for="phone_number" class="formulario__label">Telefono</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" placeholder="3224062916" name="phone_number" placeholder="Numero de telefono" id="phone_number">
                    <i class="formulario__validacion-estado far fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El telefono solo puede contener numeros con una cantidad de 10 digitos</p>
            </div>

            <!-- Grupo para el tipo de documento -->
            <div class="formulario__grupo" id="grupo__documento">
                <label for="tipo_documento" class="formulario__label">Tipo de documento</label>
                <div class="formulario__grupo-input">
                    <select name="document_type" id="tipo_documento" class="formulario__input">
                        <option value="">Seleccione un tipo de documento</option>
                        <option value="CC">Cédula de ciudadanía</option>
                        <option value="TI">Tarjeta de identidad</option>
                        <option value="RC">Registro civil</option>
                        <option value="TE">Tarjeta de extaranjeria</option>
                        <option value="CE">Cedula de extranjeria</option>
                        <option value="NIT">Numero de identificacion tributaria</option>
                        <option value="PP">Pasaporte</option>
                    </select>
                </div>
                <p class="formulario__input-error">Por favor seleccione un tipo de docuemneto</p>
            </div>

            <!-- Grupo para el numero de identificacion -->
            <div class="formulario__grupo" id="grupo__identification_number">
                <label for="identification_number" class="formulario__label">Numero de identificacion</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" name="identification_number" placeholder="1054283229" id="identification_number">
                    <i class="formulario__validacion-estado far fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Completa este campo</p>
            </div>

            <!-- Grupo para la contraseña -->
            <div class="formulario__grupo" id="grupo__contrasena">
                <label for="contrasena" class="formulario__label">Contraseña</label>
                <div class="formulario__grupo-input">
                    <input type="password" class="formulario__input" name="password" id="contrasena">
                    <i class="formulario__validacion-estado far fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">La contraseña debe conter 4 a 12 caracteres</p>
            </div>

            <!-- Mensaje de error -->
            <div class="formulario__mensaje2" id="formulario__mensaje2">
                <p class="texto"><i class="icon_error2 fa-solid fa-triangle-exclamation fa-xl"></i><b>Error: </b>Por favor complete el formulario correctamenete </p>
            </div>

            <!-- Enviar el formulario -->
            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <button type="submit" class="formulario__btn">Registrarse</button>
            </div>
            </form>
            <script src="js/formularioRegistro.js"></script>
            </div>
        </div>
    </main>
    <script src="js/script_inicio_sesion.js"></script>
    </body>
</html>
