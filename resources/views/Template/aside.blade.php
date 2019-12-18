<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ DE NAVEGACIÓN</li>
            <li>
                <a href="dashboard"><i class="fa fa-home"></i> <span>Inicio</span></a>
            </li>
            <li class="treeview">
                <a href="tickets">
                    <i class="fa fa-ticket"></i> <span>Tickets</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="tickets"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="ticketsUsuario"><i class="fa fa-user-plus"></i> Creación Usuarios</a></li>
                    <li><a href="reporteTickets"><i class="fa fa-list"></i> Reportes</a></li>
                </ul>
            </li>
            @if((Session::get('Categoria') === 3) || (Session::get('Categoria') === 2))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-archive"></i> <span>Inventario</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Session::get('Categoria') === 3)
                            <li class="treeview">
                                <a href="mobile"><i class="fa fa-comments-o"></i>Comunicaciones
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span></a>
                                <ul class="treeview-menu">
                                    <li><a href="mobile"><i class="fa fa-mobile"></i>Equipos Moviles</a></li>
                                    <li><a href="mobile"><i class="fa fa-phone"></i>Lineas Moviles</a></li>
                                </ul>
                            </li>
                        @endif
                        @if(Session::get('Categoria') === 2)
                            <li><a href="laptop"><i class="fa fa-desktop"></i> Equipos</a></li>
                            <li><a href="printers"><i class="fa fa-keyboard-o"></i> Perifericos</a></li>
                            <li><a href="perifericos"><i class="fa fa-tint"></i> Consumibles</a></li>
                            <li><a href="perifericos"><i class="fa fa-share-square"></i> Asignaciones</a></li>
                            <li><a href="perifericos"><i class="fa fa-print"></i> Impresoras</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Session::get('Rol') === 1)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-archive"></i> <span>Inventario</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="mobile"><i class="fa fa-comments-o"></i>Comunicaciones
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span></a>
                            <ul class="treeview-menu">
                                <li><a href="mobile"><i class="fa fa-mobile"></i>Equipos Moviles</a></li>
                                <li><a href="mobile"><i class="fa fa-phone"></i>Lineas Moviles</a></li>
                            </ul>
                        </li>
                        <li><a href="laptop"><i class="fa fa-desktop"></i> Equipos</a></li>
                        <li><a href="printers"><i class="fa fa-keyboard-o"></i> Perifericos</a></li>
                        <li><a href="perifericos"><i class="fa fa-tint"></i> Consumibles</a></li>
                        <li><a href="perifericos"><i class="fa fa-share-square"></i> Asignaciones</a></li>
                        <li><a href="perifericos"><i class="fa fa-print"></i> Impresoras</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gear"></i> <span>Administración</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="usuarios"><i class="fa fa-user"></i> Usuarios</a></li>
                        <li><a href="roles"><i class="fa fa-user-secret"></i> Roles Y Categoria</a></li>
                        <li><a href="sedes"><i class="fa fa-map"></i> Sedes</a></li>
                    </ul>
                </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
