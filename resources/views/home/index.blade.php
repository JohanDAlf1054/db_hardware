@auth
@include('include.barra', ['modo' => 'Inicio'])
<link rel="stylesheet" href="{{asset('css/dashboard/style.css')}}">
    <br>
    <div class="contenedor-toast" id="contenedor-toast">
    {{--  Aqui trae las notificaciones por medio de javaescript  --}}
    {{--  <div class="toast exito" id="1">
        <div class="contenido">
            <div class="icono">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                </svg>
            </div>
            <div class="texto">
                <p class="titulo">Exito!</p>
                <p class="descripcion">Se ha agregado el tercero.</p>
            </div>
        </div>
        <button class="btn-cerrar">
            <div class="icono">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
        </button>
    </div>  --}}
    {{--  <div class="toast error" id="2">
        <div class="contenido">
            <div class="icono">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 16 16">
                    <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
            </div>
            <div class="texto">
                <p class="titulo">Atencion!</p>
                <p class="descripcion">Se ha inactivado la persona</p>
            </div>
        </div>
        <button class="btn-cerrar">
            <div class="icono">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
        </button>
    </div>  --}}
    </div>
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <body>
    
        <div class="container">
            
    
            <!-- Main Content -->
            <main>
                <h1>Panel Estadisticas</h1>
                <!-- Analyses -->
                <div class="analyse">
                    <div class="sales">
                        <div class="status">
                            <div class="info">
                                <h3>Total Ventas</h3>
                                <h1>$65,024</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>+81%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="visits">
                        <div class="status">
                            <div class="info">
                                <h3>Productos</h3>
                                <h1>24,981</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>-48%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="searches">
                        <div class="status">
                            <div class="info">
                                <h3>Searches</h3>
                                <h1>14,147</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>+21%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="searches">
                        <div class="status">
                            <div class="info">
                                <h3>Searches</h3>
                                <h1>14,147</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>+21%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="visits">
                        <div class="status">
                            <div class="info">
                                <h3>Site Visit</h3>
                                <h1>24,981</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>-48%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sales">
                        <div class="status">
                            <div class="info">
                                <h3>Total Sales</h3>
                                <h1>$65,024</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>+81%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Analyses -->
    
                <!-- New Users Section -->
                {{-- <div class="new-users">
                    <h2>Nuevos Usuarios</h2>
                    <div class="user-list">
                        <div class="user">
                            <img src="images/profile-2.jpg">
                            <h2>Jack</h2>
                            <p>54 Min Ago</p>
                        </div>
                        <div class="user">
                            <img src="images/profile-3.jpg">
                            <h2>Amir</h2>
                            <p>3 Hours Ago</p>
                        </div>
                        <div class="user">
                            <img src="images/profile-4.jpg">
                            <h2>Ember</h2>
                            <p>6 Hours Ago</p>
                        </div>
                        <div class="user">
                            <img src="images/plus.png">
                            <h2>More</h2>
                            <p>New User</p>
                        </div>
                    </div>
                </div> --}}
                <!-- End of New Users Section -->
    
                <!-- Recent Orders Table -->
                <div class="recent-orders">
                    <h2>Recent Orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Number</th>
                                <th>Payment</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <td>HLF</td>
                            <td>001</td>
                            <td>Master Card</td>
                            <td>Pending</td>
                        </tbody>
                        <tbody>
                            <td>HLF</td>
                            <td>001</td>
                            <td>Master Card</td>
                            <td>Pending</td>
                        </tbody>
                        <tbody>
                            <td>HLF</td>
                            <td>001</td>
                            <td>Master Card</td>
                            <td>Pending</td>
                        </tbody>
                        <tbody>
                            <td>HLF</td>
                            <td>001</td>
                            <td>Master Card</td>
                            <td>Pending</td>
                        </tbody>
                    </table>
                    <a href="#">Show All</a>
                </div>
                <!-- End of Recent Orders -->
    
            </main>
            <!-- End of Main Content -->
    
            <!-- Right Section -->
            <div class="right-section">
                {{-- <div class="nav">
                    <button id="menu-btn">
                        <span class="material-icons-sharp">
                            menu
                        </span>
                    </button>
                    <div class="dark-mode">
                        <span class="material-icons-sharp active">
                            light_mode
                        </span>
                        <span class="material-icons-sharp">
                            dark_mode
                        </span>
                    </div>
    
                    <div class="profile">
                        <div class="info">
                            <p>Hey, <b>Reza</b></p>
                            <small class="text-muted">Admin</small>
                        </div>
                        <div class="profile-photo">
                            <img src="images/profile-1.jpg">
                        </div>
                    </div>
    
                </div>
                <!-- End of Nav -->
     --}}
                <div class="user-profile">
                    <div class="logo">
                        <img src="{{asset('img/logo2.png')}}">
                        <h2>AsmrProg</h2>
                        <p>Fullstack Web Developer</p>
                    </div>
                </div>
    
                <div class="reminders">
                    <div class="header">
                        <h2>Reminders</h2>
                        <span class="material-icons-sharp">
                            notifications_none
                        </span>
                    </div>
    
                    <div class="notification">
                        <div class="icon">
                            <span class="material-icons-sharp">
                                volume_up
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Workshop</h3>
                                <small class="text_muted">
                                    08:00 AM - 12:00 PM
                                </small>
                            </div>
                            <span class="material-icons-sharp">
                                more_vert
                            </span>
                        </div>
                    </div>
    
                    <div class="notification deactive">
                        <div class="icon">
                            <span class="material-icons-sharp">
                                edit
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Workshop</h3>
                                <small class="text_muted">
                                    08:00 AM - 12:00 PM
                                </small>
                            </div>
                            <span class="material-icons-sharp">
                                more_vert
                            </span>
                        </div>
                    </div>
    
                    <div class="notification add-reminder">
                        <div>
                            <span class="material-icons-sharp">
                                add
                            </span>
                            <h3>Add Reminder</h3>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
        <script src="{{asset('js/orders.js')}}"></script>
        <script src="{{asset('js/index.js')}}"></script>
    </body>
    </html>

@endauth
{{--  Creacion de la vista cuendo la persona no esta registrada  --}}
@guest
    @include('include.falta_sesion')
@endguest
