@auth
@include('include.barra', ['modo' => 'Inicio'])
<link rel="stylesheet" href="{{asset('css/dashboard/style.css')}}">
    <br>
    <div class="contenedor-toast" id="contenedor-toast">
    </div>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/estilos_footer.css') }}" type="text/css">
    <body>
        <div class="container">
            <!-- Main Content -->
            <main>
                <h1>Panel Administrativo</h1>
                <!-- Analyses -->
                <div class="analyse">
                    <div class="sales">
                        <div class="status">
                            <a class="info" href="{{route('sales.index')}}">
                                <h3>Total Ventas</h3>
                                <h1>
                                    {{{'$' . $sales}}}
                                </h1>
                            </a>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>{{$sales . '%'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="visits">
                        <div class="status">
                            <div class="info">
                                <h3>Total Compras</h3>
                                <h1>
                                    {{'$' . $purchase}}
                                </h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>{{$purchase . '%'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="searches">
                        <div class="status">
                                <a class="info" href="{{route('products.index')}}">
                                    <h3>Productos</h3>
                                    <h1>
                                        {{'$' . $productos}}
                                    </h1>
                                </a>
                                <div class="progresss">
                                    <svg>
                                        <circle cx="38" cy="38" r="36"></circle>
                                    </svg>
                                    <div class="percentage">
                                        <p>{{$productos . '%'}}</p>
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
                    <h2>Ventas Recientes</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>N° Factura</th>
                                <th>Fecha</th>
                                <th>Vendedor</th>
                                <th>Forma de Pago</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $dataSales as $data )
                                <tr>
                                    <td>{{ $data->bill_numbers}}</td>
                                    <td>{{ $data->dates}}</td>
                                    <td>{{ $data->sellers}}</td>
                                    <td>{{ $data->payments_methods}}</td>
                                    <td>{{ $data->net_total}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="#">Mostrar Todas</a>
                </div>
                <div class="recent-orders">
                    <h2>Compras Recientes</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>N° Factura</th>
                                <th>Fecha</th>
                                <th>Vendedor</th>
                                <th>Forma de Pago</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $dataSales as $data )
                                <tr>
                                    <td>{{ $data->bill_numbers}}</td>
                                    <td>{{ $data->dates}}</td>
                                    <td>{{ $data->sellers}}</td>
                                    <td>{{ $data->payments_methods}}</td>
                                    <td>{{ $data->net_total}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="#">Mostrar Todas</a>
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
                <!-- End of Nav -->--}}
                <div class="user-profile">
                    <div class="logo">
                        @if(auth()->user()->hasRole('Administrador'))
                            <img src="{{ asset('img/dashboard/logo_admin.png') }}">
                        @elseif(auth()->user()->hasRole('Trabajador'))
                            <img src="{{ asset('img/dashboard/logo_empleado.png') }}">
                        @else
                            <img src="{{ asset('img/dashboard/logo_panel.png') }}">
                        @endif
                        @if(auth()->user()->roles->count() > 0)
                            <h2>
                                @foreach (auth()->user()->roles as $role)
                                    <p class="badge bg-dark">{{ $role->name }}</p>
                                @endforeach
                            </h2>
                        @else
                            <h2>
                                <p class="badge bg-dark">Sin Rol</p>
                            </h2>
                        @endif
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                </div>

                <div class="reminders">
                    <div class="header">
                        <h2>Notificaciones</h2>
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
@guest
    @include('include.falta_sesion')
@endguest
