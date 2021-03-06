<header class="navbar navbar-inverse navbar-fixed-top">
    <!-- Left Header Navigation -->
    <ul class="nav navbar-nav-custom">
        <!-- Main Sidebar Toggle Button -->
        <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
            </a>
        </li>
        <!-- END Main Sidebar Toggle Button -->

        <!-- Header Link -->
        <li class="hidden-xs animation-fadeInQuick">
            <a href="/"><strong> <i class="fa fa-home"></i> Inicio</strong></a>
        </li>
        @if(Auth::user()->isAdmin())
            <li class="hidden-xs animation-fadeInQuick">
                <a href="admin"><strong> <i class="fa fa-user"></i> Administrador</strong></a>
            </li>
            <li class="hidden-xs animation-fadeInQuick">
                <a href="/estadisticas"><strong> <i class="fa fa-bar-chart"></i> Estadísticas</strong></a>
            </li>
            <li class="hidden-xs animation-fadeInQuick">
                <a href="/admin/categories"><strong><i class="fa fa-folder-open"></i> Categorías</strong></a>
            </li>
            <li class="hidden-xs animation-fadeInQuick">
                <a href="/admin/tenderos"><strong><i class="fa fa-user"></i> Tenderos</strong></a>
            </li>
            <li class="hidden-xs animation-fadeInQuick">
                <a href="/admin/productores"><strong><i class="fa fa-users"></i> Productores</strong></a>
            </li>
        @endif
        <!-- END Header Link -->
    </ul>
    <!-- END Left Header Navigation -->

    <!-- Right Header Navigation -->
    <ul class="nav navbar-nav-custom pull-right">
        <!-- Search Form -->
        <li>
            {!! Form::open(['route' => 'home', 'method' => 'get', 'class' => 'navbar-form-custom']) !!}
                {!! Form::text('text', null, ['class' => 'form-control', 'placeholder' => 'Buscar..']) !!}
            {!! Form::close() !!}
        </li>
        <!-- END Search Form -->

        <!-- Alternative Sidebar Toggle Button -->
        <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                <i class="gi gi-settings"></i>
            </a>
        </li>
        <!-- END Alternative Sidebar Toggle Button -->

        <!-- User Dropdown -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Auth::user()->image }}" alt="Menú de Usuario">
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">
                    <strong>{{ ucwords(Auth::user()->name) }}</strong>
                </li>
                {{-- <li>
                    <a href="page_app_email.html">
                        <i class="fa fa-inbox fa-fw pull-right"></i>
                        Mensajes
                    </a>
                </li>
                <li>
                    <a href="page_app_social.html">
                        <i class="fa fa-pencil-square fa-fw pull-right"></i>
                        Mi Perfil
                    </a>
                </li>
                <li class="divider"><li>
                <li>
                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                        <i class="gi gi-settings fa-fw pull-right"></i>
                        Configuración
                    </a>
                </li>
                <li>
                    <a href="page_ready_lock_screen.html">
                        <i class="gi gi-lock fa-fw pull-right"></i>
                        Bloquear
                    </a>
                </li> --}}
                <li>
                    <a href="/auth/logout">
                        <i class="fa fa-power-off fa-fw pull-right"></i>
                        Cerrar sesión
                    </a>
                </li>
            </ul>
        </li>
        <!-- END User Dropdown -->
    </ul>
    <!-- END Right Header Navigation -->
    </header>